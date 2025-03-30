# The Highway - Online Food Store

Welcome to **The Highway**, an online restaurant that delivers delicious meals straight to your doorstep. This project provides a full-featured food ordering platform with customer support, order management, and discounts.

## Features
- **Order Management**: Customers can browse the menu, add items to their cart, and place orders.
- **Custom Orders API**: A backend API to handle orders efficiently.
- **Delivery Service**: Orders are delivered directly to customers.
- **Discount System**: Special discounts are available on select orders.
- **Tidio Chatbot**: Integrated chatbot for customer support.
- **User Authentication**: Secure login and registration system.
- **Wishlist & Reviews**: Users can add items to their wishlist and leave reviews.
- **Admin Dashboard**: Manage products, orders, and user interactions.

## Technologies Used
- **PHP & MySQL** for backend development
- **JavaScript** for frontend interactions
- **Docker & Docker Compose** for containerized deployment
- **Tidio Chatbot** for real-time customer support

## Setup Instructions
### Prerequisites
- Docker & Docker Compose installed

### Running the App with Docker Compose
1. Clone the repository:
   ```sh
   git clone https://github.com/sospeterkedogo/TheHighway.git
   cd the-highway
   ```
2. Update environment variables in `.env` (e.g., database credentials, API keys).
3. Start the application:
   ```sh
   docker-compose up -d
   ```
4. Access the application at `http://localhost:8000`

## API Endpoints
### Orders API
- **Create Order:** `POST /api/orders`
- **Get Order by ID:** `GET /api/orders/{id}`
- **Update Order:** `PUT /api/orders/{id}`
- **Delete Order:** `DELETE /api/orders/{id}`

## Contact
For support, open an issue on GitHub.

---
**The Highway** - Bringing good food to your doorstep!

