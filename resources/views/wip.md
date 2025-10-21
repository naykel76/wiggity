## Core Concept: Grid Template Areas

The magic happens in these three properties working together:

```css
grid-template-columns: 250px 1fr 250px;   /* Defines 3 columns */
grid-template-rows: auto 1fr auto;        /* Defines 3 rows */
grid-template-areas:                      /* Maps areas to grid cells */
    "header header header"                /* Row 1: header spans all 3 columns */
    "sidebar main aside"                  /* Row 2: 3 separate columns */
    "footer footer footer";               /* Row 3: footer spans all 3 columns */
```

## How It Works

**Columns:**
- `250px` = Fixed width
- `1fr` = Takes remaining space (flexible)
- `250px` = Fixed width

**Rows:**
- `auto` = Sized by content
- `1fr` = Takes remaining vertical space
- `auto` = Sized by content

**Areas:**
- Each quoted string = one row
- Each word = one column
- Repeating the same word = element spans multiple cells




**Sidebar (2 columns):**

```css
grid-template-columns: 250px 1fr;
grid-template-areas: "sidebar main";

@media (max-width: 768px) {
    grid-template-columns: 1fr;
    grid-template-areas: "main" "sidebar";
}
```









## Quick Layout Examples

**Sidebar (2 columns):**
```css
grid-template-columns: 250px 1fr;
grid-template-areas:
    "header header"
    "aside main"
    "footer footer";
```

**Full-width (no sidebars):**
```css
grid-template-columns: 1fr;
grid-template-areas:
    "header"
    "main"
    "footer";
```

**Sidebar on Left:**
```css
grid-template-columns: 250px 1fr;
grid-template-areas:
    "header header"
    "sidebar main"
    "footer footer";
```


## Making It Responsive

Just redefine the columns and areas at each breakpoint:

```css
@media (max-width: 768px) {
    grid-template-columns: 1fr;
    grid-template-areas:
        "header"
        "main"
        "sidebar"
        "footer";
}
```













## Key Rules

1. **Every area name must form a rectangle** - you can't make L-shapes or weird patterns
2. **Area names must match your CSS** - `grid-area: sidebar` connects to `"sidebar"` in template
3. **Use dots (`.`) for empty cells:**
   ```css +torchlight-css
   grid-template-areas:
       "header header ."
       "sidebar main aside"
       "footer footer footer";
   ```

## Responsive Pattern

Your code shows the standard pattern:
- **Desktop:** Full 3-column layout
- **Tablet:** Collapse to 2 columns, stack aside below main
- **Mobile:** Single column, stack everything

To change responsive behavior, just redefine `grid-template-columns` and `grid-template-areas` at each breakpoint!

## Quick Experiments You Can Try

**Want sidebar on right instead?**
Change line 6 to: `"main sidebar aside"`

**Want to remove aside completely?**
Change columns to: `grid-template-columns: 250px 1fr;`
Change areas to:
```css +torchlight-css
"header header"
"sidebar main"
"footer footer"
```
Then delete the aside HTML element.

**Want 4 equal columns?**
```css +torchlight-css
grid-template-columns: 1fr 1fr 1fr 1fr;
grid-template-areas:
    "header header header header"
    "col1 col2 col3 col4"
    "footer footer footer footer";
```

What specific layout are you trying to build? I can show you the exact code for it!