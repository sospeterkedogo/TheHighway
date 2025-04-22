# The Highway Restaurant Website

A modern, responsive restaurant website built with PHP, MySQL, and modern web technologies. This platform serves as an online presence for The Highway Restaurant, featuring menu browsing, online ordering, and customer engagement features.

## Features

- **Modern UI/UX Design**
  - Responsive layout that works on all devices
  - Clean, professional interface
  - Smooth animations and transitions
  - Custom font combinations for optimal readability

- **Menu Management**
  - Dynamic menu categories
  - Product listings with images and descriptions
  - Real-time stock management
  - Special deals and best sellers sections

- **Shopping Cart**
  - Real-time cart updates
  - Quantity management
  - Stock validation
  - Persistent cart sessions

- **User Experience**
  - Intuitive navigation
  - Search functionality
  - Contact form for customer inquiries
  - Mobile-responsive design

## Technical Stack

- **Backend**
  - PHP 8.2
  - MySQL 8.0
  - Custom MVC-like architecture
  - PDO for database operations

- **Frontend**
  - HTML5
  - CSS3 with modern features (Grid, Flexbox, Variables)
  - Vanilla JavaScript
  - Google Fonts integration

- **Infrastructure**
  - Docker containerization
  - Nginx web server
  - PHP-FPM for processing
  - MySQL for data storage

## Project Structure

```
websites/thehighway/
├── public/              # Publicly accessible files
│   └── index.php       # Main entry point
├── templates/          # HTML templates
├── css/               # Stylesheets
│   └── main.css      # Main stylesheet
├── config/            # Configuration files
├── Dockerfile         # Docker configuration
├── docker-compose.yml # Docker services setup
└── nginx.conf         # Nginx configuration
```

## Getting Started

### Prerequisites

- Docker and Docker Compose
- Git
- PHP 8.2+
- MySQL 8.0+

### Installation

1. Clone the repository:
   ```terminal
   git clone [https://github.com/sospeterkedogo/TheHighway]
   cd websites/thehighway
   ```

2. Configure environment variables:
   ```terminal
   cp .env.example .env
   # Edit .env with your database credentials
   ```

3. Start the application:
   ```terminal
   docker-compose up -d
   ```

4. Access the application:
   - Local: http://localhost:8080
   - Production: [Your domain]

## Development

### Local Development

1. Start the development environment:
   ```terminal
   docker-compose up -d
   ```

2. Make changes to the codebase

3. View changes in real-time at http://localhost:8080

### Database Management

- The application uses MySQL for data storage
- Database migrations are handled through the application
- Backup your database regularly

## Deployment

The application can be deployed on various platforms:

1. **Traditional Hosting**
   - Upload files to web server
   - Configure MySQL database
   - Set up Nginx/Apache

2. **Containerized Deployment**
   - Build Docker image
   - Deploy to container platform
   - Configure environment variables

3. **Cloud Platforms**
   - Google Cloud Platform
   - AWS
   - Azure
   - Render

## Security Considerations

- Input validation on all forms
- Prepared statements for database queries
- Session management
- Secure password handling
- Regular security updates

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

For any queries or support, please contact:
- Email: [Your Email]
- Website: [Your Website] 