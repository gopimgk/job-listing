# Laravel Job Listing App

## 🔧 Setup Instructions

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install && npm run dev
php artisan serve

📦 API Usage
Authentication
Use Laravel Sanctum for auth.
bash
CopyEdit
# Register
curl -X POST http://localhost/api/register -d "name=John&email=john@example.com&password=secret&password_confirmation=secret"

# Login
curl -X POST http://localhost/api/login -d "email=john@example.com&password=secret"

# Get Jobs
curl http://localhost/api/jobs

Or include a Postman Collection in your repo as postman_collection.json.
🌐 Live URL
https://your-app-name.onrender.com
yaml
CopyEdit

---

## ✅ Bonus Checklist

- [ ] Livewire or Vue used in job form
- [ ] Pagination working in listing
- [ ] Deploy to Render with working `.env`
- [ ] Public GitHub repo
- [ ] README with setup, API, and deployed link

---

Let me know:
- Do you want a Livewire or Vue form?
- Do you need help creating the Postman collection or `.env` for Render?

I'll help you finish and deploy it fast.

