# 🚀 TrackVerse - Hostinger Deployment Guide

## ✅ Files Ready to Upload

Your production build is ready! Here's what you need to upload to Hostinger.

---

## 📦 STEP 1: Upload These Folders/Files

### **Upload the ENTIRE `public/build` folder**
- Location: `c:\laragon\www\trackverse-app\public\build`
- Upload to: `public/build` on Hostinger
- **Action:** Replace the entire folder

### **Upload the updated `routes/web.php` file**
- Location: `c:\laragon\www\trackverse-app\routes\web.php`
- Upload to: `routes/web.php` on Hostinger
- **Action:** Replace the file

### **Update your `.env` file on Hostinger**
- Reference: `c:\laragon\www\trackverse-app\.env.production`
- **Important:** You need to update these values in your Hostinger `.env`:
  ```
  APP_ENV=production
  APP_DEBUG=false
  APP_URL=https://hotpink-moose-776723.hostingersite.com
  LOG_LEVEL=error
  
  DB_DATABASE=your_actual_database_name
  DB_USERNAME=your_actual_database_user
  DB_PASSWORD=your_actual_database_password
  ```

---

## 🗑️ STEP 2: Delete These Files on Hostinger

### **Delete `public/hot` file (if it exists)**
- Location: `public/hot` on Hostinger
- **Action:** DELETE this file completely
- **Why:** This file tells Laravel to use your local dev server

### **Clear cached views**
- Location: `storage/framework/views/` on Hostinger
- **Action:** Delete ALL files inside this folder (keep the folder itself)
- **Why:** Old cached views still reference the local dev server

---

## 🔧 STEP 3: Clear Cache via Browser

After uploading all files:

1. Visit this URL in your browser:
   ```
   https://hotpink-moose-776723.hostingersite.com/clear-cache
   ```

2. You should see:
   ```
   Cache cleared successfully! You can now close this page and refresh your dashboard.
   ```

3. Go to your dashboard and test if modals close properly

---

## 🧪 STEP 4: Test Everything

1. **Login:** https://hotpink-moose-776723.hostingersite.com/login
2. **Test modals:** Click on the user profile dropdown - it should close when you click outside
3. **Test Projects dropdown:** Click on "PROJECTS" - it should toggle open/close
4. **Check console:** Press F12, check Console tab - should have NO errors about `[::1]:5173`

---

## 🔒 STEP 5: Security (After Everything Works)

Once the site is working, remove the cache clearing route:

1. Edit `routes/web.php` on Hostinger
2. Delete lines 11-19 (the `/clear-cache` route)
3. Save the file

---

## ⚠️ Important Notes

- **NEVER upload the `public/hot` file** to production
- **Always run `npm run build`** before uploading
- **Always set `APP_ENV=production`** on the server
- **Always set `APP_DEBUG=false`** on the server

---

## 🆘 Troubleshooting

### If modals still won't close:

1. **Check if `hot` file exists:**
   - Go to `public/` folder on Hostinger
   - Make sure there's NO file named `hot`

2. **Check browser console:**
   - Press F12
   - Look for errors about `[::1]:5173`
   - If you see these, cache wasn't cleared properly

3. **Manually clear cache:**
   - Delete all files in `storage/framework/views/`
   - Delete all files in `storage/framework/cache/data/`
   - Visit `/clear-cache` again

4. **Check .env file:**
   - Make sure `APP_ENV=production`
   - Make sure there's NO line with `VITE_DEV_SERVER_URL`

---

## 📞 Need Help?

If you still have issues after following all steps, check:
- Browser console for JavaScript errors
- Network tab to see which files are loading
- Page source to see if scripts point to `/build/assets/` or `[::1]:5173`

---

**Good luck! 🎉**
