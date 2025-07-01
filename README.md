
# job-listing
# Laravel Job Listing App

## 🔧 Setup Instructions

```bash
git clone https://github.com/gopimgk/job-listing.git
cd job-listing
composer install
set .env
php artisan key:generate
php artisan migrate
npm install && npm run dev
php artisan serve

postman Api calls

POST http://localhost:8000/api/register
Content-Type: application/json

{
  "name": "Gopi Krishna",
  "email": "gopi@example.com",
  "password": "password",
  "password_confirmation": "password"
}


POST http://localhost:8000/api/login
Content-Type: application/json

{
  "email": "gopi@example.com",
  "password": "password"
}

copy Type: Bearer Token


POST http://localhost:8000/api/jobs
Authorization: Bearer <your_token>
Content-Type: application/json
{
   "title": "Laravel Developer",
   "description": "Looking for Laravel developer with 3 years experience.",
   "location": "Remote",
   "type": "Full-time",
   "company": "my company"
 }


GET http://localhost:8000/api/jobs
Authorization: Bearer <your_token>



GET /api/jobs/1
Authorization: Bearer <your_token>

