# Advanced Image Styling Guide

This guide provides detailed instructions on how to style and format images in your blog posts using our enhanced Markdown syntax.

## Table of Contents

- [Basic Image Syntax](#basic-image-syntax)
- [Setting Image Dimensions](#setting-image-dimensions)
- [Cover Images](#cover-images)
- [Controlling Image Position](#controlling-image-position)
- [Combining Attributes](#combining-attributes)
- [Common Use Cases](#common-use-cases)
- [Troubleshooting](#troubleshooting)

## Basic Image Syntax

The standard Markdown image syntax is:

```markdown
![Alt text](/path/to/image.jpg)
```

- `Alt text` is what appears if the image fails to load or for screen readers
- `/path/to/image.jpg` is the path to your image file

For blog images, place your files in the `/public/images/blog/` directory.

## Setting Image Dimensions

You can control the dimensions of images using the `=WIDTHxHEIGHT` syntax after the image URL:

```markdown
![Alt text](/images/blog/example.jpg =300x200)
```

This renders as:

```html
<img src="/images/blog/example.jpg" alt="Alt text" style="width: 300px; height: 200px;">
```

### Width Only

To set only the width and let height adjust proportionally:

```markdown
![Alt text](/images/blog/example.jpg =300x)
```

This renders as:

```html
<img src="/images/blog/example.jpg" alt="Alt text" style="width: 300px;">
```

### Height Only

To set only the height and let width adjust proportionally:

```markdown
![Alt text](/images/blog/example.jpg =x200)
```

This renders as:

```html
<img src="/images/blog/example.jpg" alt="Alt text" style="height: 200px;">
```

## Cover Images

Use the `{cover}` attribute to create full-width cover images:

```markdown
![Alt text](/images/blog/example.jpg){cover}
```

This creates an image that:
- Spans the full width of the content area
- Has a maximum height (500px by default, 300px on mobile)
- Maintains aspect ratio using `object-fit: cover`
- Centers the image in its container

Cover images are perfect for:
- Post header images
- Section dividers
- Photo showcases
- Feature highlights

## Controlling Image Position

When using cover images or when setting specific dimensions, you might need to control which part of the image is visible. You can do this with the `position` attribute:

```markdown
![Alt text](/images/blog/example.jpg){position=50% 50%}
```

The position uses the CSS `object-position` property, accepting:

### Percentage Values

```markdown
![Alt text](/images/blog/example.jpg){position=0% 0%}     <!-- Top-left corner -->
![Alt text](/images/blog/example.jpg){position=100% 0%}   <!-- Top-right corner -->
![Alt text](/images/blog/example.jpg){position=50% 50%}   <!-- Center (default) -->
![Alt text](/images/blog/example.jpg){position=0% 100%}   <!-- Bottom-left corner -->
![Alt text](/images/blog/example.jpg){position=100% 100%} <!-- Bottom-right corner -->
```

### CSS Keywords

```markdown
![Alt text](/images/blog/example.jpg){position=top}
![Alt text](/images/blog/example.jpg){position=bottom}
![Alt text](/images/blog/example.jpg){position=left}
![Alt text](/images/blog/example.jpg){position=right}
![Alt text](/images/blog/example.jpg){position=center}    <!-- Same as 50%,50% -->
```

### Combined Keywords

```markdown
![Alt text](/images/blog/example.jpg){position=top left}
![Alt text](/images/blog/example.jpg){position=bottom right}
```

## Combining Attributes

You can combine dimensions, cover mode, and positioning to achieve precise control:

```markdown
![Alt text](/images/blog/example.jpg =800x300){cover position=top}
```

This creates an image that:
- Has a specified width/height (applied via CSS)
- Uses cover mode to fill its container
- Positions the image at the top of the visible area

## Common Use Cases

### Hero Image (Full Width)

```markdown
![Hero Image](/images/blog/hero.jpg){cover}
```

### Portrait with Focus on Face

```markdown
![Portrait](/images/blog/portrait.jpg =300x400){position=50% 30%}
```

### Landscape with Focus on Horizon

```markdown
![Landscape](/images/blog/landscape.jpg =600x300){position=50% 33%}
```

### Screenshot with Specific Size

```markdown
![Screenshot](/images/blog/screenshot.jpg =500x)
```

### Wide Banner with Bottom Focus

```markdown
![Banner](/images/blog/banner.jpg =800x200){position=center bottom}
```

## Troubleshooting

### Image Not Displaying

- Check that the file path is correct
- Verify the image exists in the specified location
- Make sure the file extension matches exactly (case-sensitive)

### Dimensions Not Applied

- Check for typos in the dimension syntax
- Ensure there's a space before the equals sign: ` =300x200`
- Verify the values are numeric only

### Cover Mode Not Working

- Make sure the `{cover}` attribute is right after the closing parenthesis
- Check that the CSS file is properly loaded
- Verify the image container has sufficient width

### Position Not Applied

- Check the position syntax (use spaces for percentage values: `50% 50%`)
- Ensure the position attribute is inside the curly braces
- For combined attributes, place position after cover: `{cover position=center}`

## Advanced Example

Here's an example of a blog post with various image styles:

```markdown
# My Travel Adventure

![Stunning landscape](/images/blog/landscape.jpg =800x400){cover position=50% 33%}

## Day 1: Arrival

Our journey began with a breathtaking view from our hotel room.

![Hotel view](/images/blog/hotel-view.jpg =400x)

## Day 2: Exploration

We discovered this hidden gem off the beaten path.

![Hidden waterfall](/images/blog/waterfall.jpg){cover}

Close-up of the intricate rock formations:

![Rock formation](/images/blog/rocks.jpg =300x300){position=center}
``` 