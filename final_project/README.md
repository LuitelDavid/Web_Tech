# The Disciplined Canvas - Habit Tracker & To-Do List

A sleek, professional web-based productivity application designed to help users build lasting habits and manage daily tasks with ease. This project focuses on visual consistency and data-driven progress tracking to keep users motivated and disciplined.

## Project Description
**The Disciplined Canvas** is a full-stack web application that combines the power of a habit tracker with a streamlined to-do list. In today's fast-paced world, maintaining consistency is the biggest hurdle to personal growth. This platform provides a centralized hub where users can define their daily routines, manage ad-hoc tasks, and visualize their journey through dynamic progress metrics.

- **Dual-Purpose Platform**: Manage long-term habits and short-term tasks in one unified interface.
- **Productivity Focused**: Minimalist design to reduce cognitive load and keep focus on execution.
- **Consistency Tracking**: Real-time feedback on streaks and completion rates to encourage daily engagement.

## Features
- **Habit Management**: Easily add new habits with descriptions and remove them when they are no longer part of your routine.
- **Interactive To-Do List**: Quick-entry task management for daily errands that reset every midnight to keep your workspace fresh.
- **Dynamic Progress Tracking**: A real-time progress bar on the dashboard calculates your overall completion percentage for the day.
- **Streak System**: Visual representation of your consistency with a "Top Streak" counter and status indicators.
- **Visual Performance Review**: Monitor your routine's health through color-coded habit cards and progress dots.
- **Responsive Design**: Fully optimized for both desktop and mobile viewing using modern CSS techniques.

## How It Works
1. **Access**: The user opens the website in a modern web browser.
2. **Setup**: After logging in, users can populate their "Today's Discipline" by adding habits.
3. **Daily Action**: Mark habits and tasks as completed throughout the day.
4. **Real-time Feedback**: The progress bar and streak counters update immediately upon completion, providing instant gratification.
5. **Monitoring**: Users can review their "Top Streak" and "Overall Progress" at a glance to stay accountable over time.

## Tech Stack
- **Frontend**:
    - **HTML5**: Semantic structure for accessibility and SEO.
    - **Tailwind CSS**: Utility-first styling for a premium, responsive UI.
    - **JavaScript (Vanilla)**: Asynchronous logic using the Fetch API for a smooth, no-reload experience.
    - **Google Fonts**: "Inter" for modern, readable typography.
    - **Material Symbols**: For intuitive visual iconography.
- **Backend**:
    - **PHP**: Server-side logic for authentication and data processing.
- **Database**:
    - **MySQL**: Relational database to store user profiles, habits, tasks, and completion history.

## Project Structure
```text
/final_project
├── /auth            # Login, registration, and session management logic
├── /components      # Reusable UI fragments (e.g., header.php)
├── /config          # Database connection configuration (db.php)
├── /habits          # CRUD operations for the habit tracking system
├── /progress        # Backend logic for calculating streaks and percentages
├── /todos           # Logic for the daily to-do list management
├── index.php        # Landing page / Home
├── dashboard.php    # Main user interface and habit management hub
├── login.php        # User authentication portal
├── schema.sql       # Database structure and table definitions
└── about.php        # Project overview and mission statement
```

## Installation & Setup
To run this project locally, ensure you have a local server environment like **XAMPP** installed.

1. **Clone the Repository**:
   Place the `final_project` folder into your server's root directory (e.g., `C:/xampp/htdocs/`).
2. **Setup the Database**:
   - Open **phpMyAdmin**.
   - Create a new database named `habit_tracker` (or as specified in `config/db.php`).
   - Import the `schema.sql` file provided in the project root.
3. **Configure Connection**:
   - Navigate to `config/db.php`.
   - Update the database credentials (host, username, password) to match your local setup.
4. **Run the App**:
   - Open your browser and navigate to `http://localhost/final_project/index.php`.

## Usage
- **Registration**: Create an account to start your personalized journey.
- **Adding Habits**: Click the "New Habit" button on the dashboard to define a goal.
- **Task Management**: Use the right-hand sidebar to quickly add tasks that need to be finished today.
- **Toggling**: Click the checkmark icons to mark items as complete. Notice the dashboard stats update instantly.

## Future Improvements
- **User Authentication**: Implement OAuth (Google/Github login) for easier access.
- **Cloud Sync**: Real-time database synchronization across multiple devices.
- **Notifications/Reminders**: Push notifications or email alerts to remind users of pending habits.
- **Advanced Analytics**: Detailed charts and graphs showing long-term trends and monthly performance reports.
- **Custom Themes**: Ability to switch between Dark, Light, and custom aesthetic modes.

## Conclusion
**The Disciplined Canvas** is more than just a tool; it is a digital companion for anyone committed to self-improvement. By combining task management with habit tracking and visual data, it transforms the abstract concept of "consistency" into a tangible, measurable, and rewarding daily experience.

---
*Developed as a Final Project for Web Technology Course.*
