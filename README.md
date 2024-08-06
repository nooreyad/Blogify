# Blogify
Blogify is a feature-rich blogging platform built with Laravel. It offers a seamless user experience for both bloggers and readers.

## Features:

### User Authentication
- **Registration and Login:** Users can register and log in to access the full functionality of the platform.
- **Profile Management:** Users can view and edit their profiles, including their name, bio, and profile picture.

### Blogging
- **Create and Edit Posts:** Users can create new blog posts, view, and edit their existing posts.
- **Post Management:** Users can delete their posts and manage their content easily.
- **Rich Text Editor:** Provides a user-friendly interface for writing and formatting blog content.

### Comments
- **Commenting System:** Users can leave comments on blog posts.
- **Comment Management:** The comments are deleted if the owner of the blog post deleted the post.
- **Responsive Layout:** Comments are displayed in a responsive and user-friendly manner.

### Search
- **Search Functionality:** Users can search for blog posts by title and/or content using keywords.

### User Dashboard
- **Dashboard Overview:** Users have a personalized dashboard displaying posts, comments, and other activities.
- **Statistics:** Provides insights into user interactions, such as the number of blog posts and comments.

### Responsive Design
- **Adaptive Layouts:** The design adapts to various screen sizes and orientations.

## Installation and Setup:

1. **Clone the repository:**
- Open terminal or CMD.
- Clone the repository using the following command
```
git clone https://github.com/nooreyad/Blogify.git
```
- Open project directory:
```
cd Blogify
```

2. **Install Dependencies:**
- Ensure you have composer installed.
- Install PHP dependencies:
```
composer install
```
- Install all JavaScript dependencies using npm or yarn:
```
nmp install
```
or
```
yarn
```

3. **Set Up Environment Configuration:**
- Copy the '.env.example' file to '.env':
```
cp .env.example .env
```
- Open the '.env' file and update the following database settings with your local database information:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name (blogify)
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

4. **Generate Application Key:**
- Generate a new application key:
```
php artisan key:generate
```

5. **Run Migrations and Seeders:**
- Run the database migrations:
```
php artisan migrate
```

6. **Serve the Application:**
- Start the Laravel development server:
```
php artisan serve
```
- Open your browser and navigate to 'http://localhost:8000' to see the application running.