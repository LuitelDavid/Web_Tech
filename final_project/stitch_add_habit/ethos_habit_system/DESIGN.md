# Design System Document

## 1. Overview & Creative North Star: "The Disciplined Canvas"
This design system moves away from the cluttered, "gamified" look of typical habit trackers. Our Creative North Star is **The Disciplined Canvas**. It treats the UI not as a dashboard, but as a high-end editorial planner. 

To achieve a premium feel without relying on complex effects, we use **intentional asymmetry** and **tonal depth**. We break the "template" look by utilizing large display typography for progress metrics and generous white space to reduce cognitive load. The goal is a digital environment that feels as calm and organized as the habits the user is trying to build.

## 2. Colors & Surface Architecture
The color palette is rooted in a professional Deep Blue and a refreshing Emerald, but its sophistication comes from the "Neutral" scale which manages the background hierarchy.

### The "No-Line" Rule
**Explicit Instruction:** You are prohibited from using `1px solid` borders to define sections or cards. High-end design communicates structure through color shifts, not lines. 
- Use `surface-container-low` (#f2f4f6) for the main page background.
- Use `surface-container-lowest` (#ffffff) for primary content cards.
- The shift in hex code is the boundary.

### Surface Hierarchy & Nesting
Instead of a flat grid, treat the UI as stacked sheets of fine paper:
- **Base Level:** `surface` (#f7f9fb) for the overarching app background.
- **Section Level:** `surface-container-low` (#f2f4f6) to group related habit categories.
- **Action Level:** `surface-container-highest` (#e0e3e5) for inactive states or "empty" habit slots.

### Signature Accents
- **The Success Glow:** Use `tertiary` (#006242) for completed habit icons. To provide "soul," use a subtle gradient transition from `tertiary` (#006242) to `tertiary_container` (#007d55) on large completion buttons.
- **Primary CTAs:** Use a gradient from `primary` (#004ac6) to `primary_container` (#2563eb) for "Add Habit" buttons to ensure they feel "lifted" and intentional.

## 3. Typography: The Editorial Scale
We use **Inter** to maintain a functional, Swiss-style aesthetic. The key to the premium look is the extreme contrast between `display` and `label` sizes.

- **Display-LG (3.5rem):** Reserved for "Current Streak" or "Completion Percentage" numbers. It should feel authoritative.
- **Headline-SM (1.5rem):** Used for habit titles. Set with `on_surface` (#191c1e).
- **Body-MD (0.875rem):** For habit descriptions or notes. Use `on_surface_variant` (#434655) to create a clear visual hierarchy.
- **Label-MD (0.75rem):** For "Day of the Week" or "Last Sync" metadata. Always set in All Caps with 0.05em letter spacing to provide an "architectural" feel.

## 4. Elevation & Depth: Tonal Layering
Since we are avoiding heavy shadows and glassmorphism to ensure easy implementation, we define depth through **Tonal Layering**.

- **The Layering Principle:** Place a `surface-container-lowest` (#ffffff) card on a `surface-container-low` (#f2f4f6) background. This creates a "soft lift" that is easier on the eyes than a shadow.
- **The Ghost Border:** If a component (like a search bar) disappears into the background, use a "Ghost Border." Use `outline_variant` (#c3c6d7) at **15% opacity**. It should be felt, not seen.
- **Interactive Depth:** On hover, do not add a shadow. Instead, shift the background color from `surface-container-lowest` to `surface-container-high` (#e6e8ea).

## 5. Components

### Buttons
- **Primary:** Background: Gradient `primary` to `primary_container`. Text: `on_primary` (#ffffff). Border-radius: `DEFAULT` (0.5rem).
- **Secondary:** Background: `secondary_container` (#e0e3e5). Text: `on_secondary_container` (#626567). No border.
- **Tertiary (Ghost):** No background. Text: `primary` (#004ac6). Use for "Cancel" or "Clear" actions.

### Habit Cards & Lists
- **Forbid Dividers:** Do not use `<hr>` or border-bottom.
- **Spacing:** Use `spacing-6` (1.5rem) between cards.
- **The Habit State:** An uncompleted habit sits on `surface-container-lowest`. A completed habit transforms to `tertiary_container` (#007d55) with `on_tertiary_container` (#bdffdb) text.

### Progress Chips
- Small, pill-shaped (`rounded-full`) indicators.
- Use `primary_fixed` (#dbe1ff) background with `on_primary_fixed` (#00174b) text for "In Progress" status.

### Input Fields
- Background: `surface_container_highest` (#e0e3e5).
- Border: None, unless focused.
- Focus State: 2px solid `primary` (#004ac6).

### The "Daily Streak" Component (Custom)
- A horizontal row using `spacing-2` (0.5rem) between days.
- Each day is a square with `rounded-sm` (0.25rem). 
- Active days are `tertiary` (#006242); inactive days are `surface_variant` (#e0e3e5).

## 6. Do's and Don'ts

### Do:
- **Do** use `headline-lg` for empty states to make the "No Habits Yet" screen feel like a design choice rather than a bug.
- **Do** use `spacing-10` (2.5rem) or more for page margins to give the content "room to breathe."
- **Do** align all text to a strict vertical baseline.

### Don't:
- **Don't** use pure black (#000000) for text. Use `on_surface` (#191c1e).
- **Don't** use standard 1px borders. Use background color shifts to define containers.
- **Don't** use "Alert Red" for habit failures. Use `secondary` gray (#5c5f61) to remain encouraging and minimalist. Only use `error` (#ba1a1a) for destructive actions like "Delete Habit."