# Social-Media-Web-Development
## Description
This project is part of the Web Application Development course, focusing on building the foundation for a social media application. It's an individual assignment where the primary goal is to implement features like adding, editing, and deleting posts, as well as commenting on them.

## Key Features

### Navigation and Layout
- **Universal Navigation Menu**: Integrated on all pages for seamless navigation across the application.
- **Responsive Design**: Adapts to various screen sizes, ensuring a consistent user experience.

### Post Management
- **CRUD Operations**: Users can create, read, update, and delete posts.
- **Date and Author Display**: Each post displays its date of posting and author's name.
- **Editable Content**: Allows for editing of post titles and messages with automatic date updates.

### Comment System
- **Comment on Posts**: Users can add comments to posts, enhancing user interaction.
- **Post-Comment Association**: Each comment is linked to a specific post, maintaining content relevancy.

### User Interaction
- **Post Creation Form**: A user-friendly form on the home page for creating new posts.
- **Comment Submission**: Interface for users to add comments directly on a post's details page.

### Ordering and Validation
- **Chronological Ordering**: Posts are listed in reverse chronological order on the home page.
- **Input Validation**: Ensures the validity of post titles, author names, and messages with appropriate error messaging.

### User-Friendly Interface
- **Clear Visual Cues**: Indicates the number of comments per post on the home page.
- **Distinct User Posts Page**: A separate page listing all posts made by a specific user.

### Session Management
- **Remember User**: The system remembers the user's name after the first post/comment for the duration of the session.

### Reply and Like Features
- **Comment Replies**: Ability to reply to comments, clearly indicating the comment hierarchy.
- **Post Likes**: Users can like posts and the like count is displayed alongside each post.

## Technical Specifications

### Laravel Framework
- **Routing, View, and Session**: Utilization of Laravel's core features for efficient web application development.
- **Raw SQL Queries**: Database interactions are handled using raw SQL queries via Laravel’s DB class.

### Security and Data Integrity
- **HTML and SQL Sanitization**: Implemented to prevent security vulnerabilities like XSS and SQL injection.
- **Server-Side Validation**: Ensuring data integrity and user input validation, without relying on client-side validation.

### Design and Usability
- **Template Inheritance**: Consistent and maintainable page layouts using Laravel's blade templating system.
- **Mobile-Responsive Design**: Ensuring the application is usable on various devices and screen sizes.

### Coding Best Practices
- **Descriptive Naming**: Clear and understandable naming conventions for files, functions, and variables.
- **Code Formatting**: Well-indented and spaced code for readability.
- **Function Documentation**: Each function includes a brief description of its purpose and functionality.
