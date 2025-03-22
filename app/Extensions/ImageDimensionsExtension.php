<?php

namespace App\Extensions;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\RegexHelper;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;

/**
 * Extension that adds support for image dimensions and other attributes in markdown.
 * 
 * Dimension Examples:
 * ![Alt text](image.jpg =300x200)
 * ![Alt text](image.jpg =300x)
 * ![Alt text](image.jpg =x200)
 * 
 * Cover Image Example:
 * ![Alt text](image.jpg){cover}
 * 
 * Background Position Example:
 * ![Alt text](image.jpg){position=50%,25%}
 * 
 * Combined Examples:
 * ![Alt text](image.jpg =300x200){cover}
 * ![Alt text](image.jpg =300x){position=50%,25%}
 */
class ImageDimensionsExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        // Add event listener to process images after document is parsed
        $environment->addEventListener(DocumentParsedEvent::class, [$this, 'processImages']);
        
        // Add custom renderer
        $environment->addRenderer(Image::class, new CustomImageRenderer(), 10);
    }
    
    /**
     * Process all images in the document to extract dimensions from URLs
     */
    public function processImages(DocumentParsedEvent $event): void
    {
        $document = $event->getDocument();
        $walker = $document->walker();
        
        while ($event = $walker->next()) {
            $node = $event->getNode();
            
            if (!$event->isEntering() || !($node instanceof Image)) {
                continue;
            }
            
            $url = $node->getUrl();
            
            // Initialize attributes if not set
            $data = $node->data->export();
            if (!isset($data['attributes'])) {
                $data['attributes'] = [];
            }
            
            // Process image dimensions (=WIDTHxHEIGHT format)
            $cleanUrl = $this->processDimensions($url, $data);
            
            // Check for additional attributes in the title
            $title = $node->getTitle();
            if ($title) {
                $this->processAttributes($title, $data);
                
                // If attributes were in the title, set a cleaner title or remove it
                if ($title !== $node->getTitle()) {
                    // Check if there's any actual title left after processing attributes
                    if (trim($title)) {
                        $node->setTitle($title);
                    } else {
                        $node->setTitle(null);
                    }
                }
            }
            
            // Set the cleaned URL
            if ($cleanUrl !== $url) {
                $node->setUrl($cleanUrl);
            }
            
            // Save data back to node
            $node->data->import($data);
        }
    }
    
    /**
     * Process image dimensions from URL
     * 
     * @param string $url The image URL with possible dimensions
     * @param array &$data Node data to modify
     * @return string Cleaned URL without dimensions
     */
    private function processDimensions(string $url, array &$data): string
    {
        if (preg_match('/(.+?)\s+=(\d*)x(\d*)$/', $url, $matches)) {
            // Store the actual URL without dimensions
            $cleanUrl = $matches[1];
            
            // Initialize style attribute if not set
            if (!isset($data['attributes']['style'])) {
                $data['attributes']['style'] = '';
            }
            
            // Set width if specified
            if (!empty($matches[2])) {
                // Add to style attribute instead of width attribute
                $data['attributes']['style'] .= 'width: ' . $matches[2] . 'px; ';
            }
            
            // Set height if specified
            if (!empty($matches[3])) {
                // Add to style attribute instead of height attribute
                $data['attributes']['style'] .= 'height: ' . $matches[3] . 'px; ';
            }
            
            return $cleanUrl;
        }
        
        return $url;
    }
    
    /**
     * Process additional attributes from title or other text
     * 
     * @param string &$text The text to process (will be modified to remove attributes)
     * @param array &$data Node data to modify
     */
    private function processAttributes(string &$text, array &$data): void
    {
        // Process {cover} attribute
        if (preg_match('/{cover}/', $text)) {
            $text = str_replace('{cover}', '', $text);
            $data['attributes']['class'] = isset($data['attributes']['class']) 
                ? $data['attributes']['class'] . ' img-cover' 
                : 'img-cover';
        }
        
        // Process {position=X Y} attribute - using space-separated values (CSS standard)
        // Also still supports {position=X,Y} format for backward compatibility
        if (preg_match('/{position=([^}]+)}/', $text, $matches)) {
            $text = str_replace($matches[0], '', $text);
            $position = $matches[1];
            
            // Convert comma-separated position to space-separated CSS value (for backward compatibility)
            $position = str_replace(',', ' ', $position);
            
            $data['attributes']['style'] = isset($data['attributes']['style']) 
                ? $data['attributes']['style'] . 'object-position: ' . $position . '; ' 
                : 'object-position: ' . $position . '; ';
        }
    }
}

/**
 * Renderer for images with dimensions and custom attributes.
 */
class CustomImageRenderer implements NodeRendererInterface, ConfigurationAwareInterface
{
    private ConfigurationInterface $config;

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

    /**
     * @param Image $node
     *
     * {@inheritDoc}
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Image::assertInstanceOf($node);

        $attrs = $node->data->get('attributes', []);

        $forbidUnsafeLinks = !$this->config->get('allow_unsafe_links');
        if ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($node->getUrl())) {
            $attrs['src'] = '';
        } else {
            $attrs['src'] = $node->getUrl();
        }

        // Get alt text from child nodes
        $attrs['alt'] = $childRenderer->renderNodes($node->children());

        if (($title = $node->getTitle()) !== null) {
            $attrs['title'] = $title;
        }

        // If this is a cover image, add object-fit: cover
        if (isset($attrs['class']) && strpos($attrs['class'], 'img-cover') !== false) {
            if (isset($attrs['style'])) {
                // Only add object-fit if it's not already there
                if (strpos($attrs['style'], 'object-fit:') === false) {
                    $attrs['style'] .= 'object-fit: cover; ';
                }
            } else {
                $attrs['style'] = 'object-fit: cover; ';
            }
        }

        return new HtmlElement('img', $attrs, '', true);
    }
} 