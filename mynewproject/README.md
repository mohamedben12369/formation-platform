# Formation Management System

A comprehensive Laravel-based web application for managing training programs, user profiles, and educational content.

## 🚀 Features

### User Management
- **User Registration & Authentication** - Secure user registration and login system
- **Profile Management** - Users can manage their personal information, profile photos, and background images
- **Role-based Access Control** - Different user roles with specific permissions

### Profile Features
- **Dynamic Profile Pages** - Enhanced profile pages with background and profile photo upload
- **Skills Management** - Users can add and manage their professional competencies
- **Experience Tracking** - Professional experience management with company details and dates
- **Education Records** - Diploma and certification management

### Training System
- **Formation Management** - Create and manage training programs
- **Candidate Applications** - Application system for training programs
- **Document Management** - Upload and manage training-related documents

## 💻 Technology Stack

- **Backend**: Laravel 10+ (PHP)
- **Frontend**: Bootstrap 5, JavaScript, Blade Templates
- **Database**: MySQL/PostgreSQL
- **File Storage**: Laravel Storage
- **Authentication**: Laravel Breeze/Sanctum
- **Build Tools**: Vite

## 📋 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/formation-management-system.git
   cd formation-management-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration**
   - Update your `.env` file with database credentials
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Storage Setup**
   ```bash
   php artisan storage:link
   ```

7. **Build Assets**
   ```bash
   npm run build
   ```

## 🏃‍♂️ Usage

### Starting the Development Server
```bash
php artisan serve
```

### Running Tests
```bash
php artisan test
```

### Building for Production
```bash
npm run build
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🎯 Key Features Implementation

### Profile Management
- **Photo Upload**: Users can upload profile and background photos with real-time preview
- **Direct Upload**: Alternative quick upload options for better UX
- **Image Preview**: Real-time image preview before upload
- **File Validation**: Secure file type and size validation

### Skills & Experience
- **Competence Management**: Add, edit, and categorize professional skills
- **Experience Timeline**: Track professional experience with dates and companies
- **Education Records**: Manage diplomas and certifications

## 🗂️ Database Models

### Core Models
- `User` - Main user model with profile management
- `Formation` - Training programs and courses
- `Candidature` - Training applications and submissions
- `Competence` - User skills and competencies
- `Experience` - Professional experience records
- `Diplome` - Educational qualifications

### Supporting Models
- `Role` & `Permission` - Access control system
- `Domaine` & `SousDomaine` - Skill categorization
- `Entreprise` - Company information
- `Etablissement` - Educational institutions

## 🛠️ API Endpoints

### Profile Management
```
POST   /profile/update-photo      - Update profile photo
POST   /profile/update-background - Update background image
DELETE /profile/delete-photo      - Delete profile photo
DELETE /profile/delete-background - Delete background image
```

### Profile Sections
```
GET /profile/competences - Manage user competencies
GET /profile/experiences - Manage work experience
GET /profile/diplomes    - Manage education records
```

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Policies/            # Authorization policies
│   └── Traits/              # Reusable traits (HasImage)
├── resources/
│   ├── views/               # Blade templates
│   │   └── profile/         # Profile-related views
│   ├── js/                  # JavaScript files
│   └── css/                 # Stylesheets
├── routes/
│   ├── web.php             # Web routes
│   └── api.php             # API routes
└── database/
    ├── migrations/         # Database migrations
    └── seeders/           # Database seeders
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## 🔒 Security Features

- CSRF protection on all forms
- File upload validation and sanitization
- SQL injection prevention via Eloquent ORM
- XSS protection through Blade templating
- Secure authentication with Laravel Sanctum
- Role-based access control

## 📜 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 📞 Support

For support, please create an issue in the GitHub repository or contact the development team.

## 📝 Changelog

### Version 1.0.0
- Initial release with user authentication
- Profile management with photo uploads
- Skills and experience tracking system
- Training program management
- Document upload functionality
- Responsive UI with Bootstrap 5
