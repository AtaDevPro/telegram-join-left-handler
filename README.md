# Telegram Join/Left Handler Bot 🇮🇷

This PHP script allows a Telegram bot to manage join and left events in a group.  
It hides system messages (join/left), sends a welcome message to new users, and notifies the group admin privately.

---

## 🧠 Features

- ✅ Detect new members joining the group
- ✅ Delete the "joined" system message
- ✅ Send a custom welcome message to the group
- ✅ Notify the admin with full user info
- ✅ Detect members leaving the group
- ✅ Delete the "left" system message
- ✅ Notify the admin about the user who left

---

## 📦 Requirements

- A Telegram Bot Token
- A server with PHP 8+ and cURL enabled
- Webhook set up for your bot

---

## ⚙️ How to Use

1. Replace `API_TOKEN` with your bot token.
2. Upload the file to your PHP server.
3. Set the webhook using:
https://api.telegram.org/bot<YOUR_API_TOKEN>/setWebhook?url=https://yourdomain.com/yourfile.php

4. Make sure your server uses HTTPS.

---

## 👨‍💻 Developer

Made by [AtaDevPro](https://github.com/AtaDevPro)) 🇮🇷  

---

## 🛡 License

This project is licensed under the MIT License.

