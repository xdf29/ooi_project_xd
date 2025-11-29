# Deployment Guide for Render

This guide will walk you through deploying your Laravel application to Render.

## Prerequisites

1. A GitHub account
2. Your code pushed to a GitHub repository
3. A Render account (sign up at https://render.com)

## Step-by-Step Deployment

### Step 1: Prepare Your Code

1. **Generate Application Key** (if not already done):
   ```bash
   php artisan key:generate --show
   ```
   Copy this key - you'll need it in Step 4.

2. **Commit and Push to GitHub**:
   ```bash
   git add .
   git commit -m "Prepare for Render deployment"
   git push origin main
   ```

### Step 2: Create Render Account

1. Go to https://render.com
2. Sign up or log in
3. Connect your GitHub account (if not already connected)

### Step 3: Create New Web Service

1. In Render dashboard, click **"New +"** → **"Web Service"**
2. Connect your GitHub repository
3. Select your repository (`ooi_project`)
4. Click **"Connect"**

### Step 4: Configure Service Settings

**Basic Settings:**
- **Name**: `ooi-project` (or your preferred name)
- **Region**: Choose closest to your users (e.g., Singapore)
- **Branch**: `main` (or your default branch)
- **Root Directory**: Leave empty (root of repo)
- **Runtime**: `Docker`
- **Dockerfile Path**: `Dockerfile` (should auto-detect)
- **Docker Context**: `.` (current directory)

**Build & Deploy:**
- **Build Command**: Leave empty (handled by Dockerfile)
- **Start Command**: Leave empty (handled by Dockerfile

### Step 5: Set Environment Variables

In the Render dashboard, go to **"Environment"** tab and add:

**Required Variables:**
```
APP_NAME=Laravel
APP_ENV=production
APP_KEY=<paste the key from Step 1>
APP_DEBUG=false
APP_URL=https://your-service-name.onrender.com
```

**Logging:**
```
LOG_CHANNEL=stack
LOG_LEVEL=error
```

**Cache & Sessions:**
```
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
```

**Database (if you add one later):**
```
DB_CONNECTION=postgresql
DB_HOST=<from Render database>
DB_PORT=5432
DB_DATABASE=<from Render database>
DB_USERNAME=<from Render database>
DB_PASSWORD=<from Render database>
```

**Optional - Mail Configuration:**
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Step 6: Deploy

1. Click **"Create Web Service"**
2. Render will start building your Docker image
3. Watch the build logs - it may take 5-10 minutes
4. Once deployed, you'll get a URL like: `https://ooi-project.onrender.com`

### Step 7: Verify Deployment

1. Visit your Render URL
2. Check that your site loads correctly
3. Verify styles are working (dropdown menu, etc.)

## Optional: Add PostgreSQL Database

If you need a database later:

1. In Render dashboard: **"New +"** → **"PostgreSQL"**
2. Configure:
   - **Name**: `ooi-db`
   - **Database**: `ooi_db`
   - **User**: Auto-generated
   - **Region**: Same as your web service
3. Copy the connection details
4. Add to your web service environment variables:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=<Internal Database URL>
   DB_PORT=5432
   DB_DATABASE=ooi_db
   DB_USERNAME=<from database>
   DB_PASSWORD=<from database>
   ```
5. Redeploy your web service

## Troubleshooting

### Build Fails
- Check build logs in Render dashboard
- Ensure all files are committed to GitHub
- Verify Dockerfile syntax

### 500 Error After Deployment
- Check environment variables are set correctly
- Verify `APP_KEY` is set
- Check logs in Render dashboard

### Styles Not Loading
- Ensure `public/hot` file doesn't exist (should be in .gitignore)
- Verify `public/dist` and `public/build` directories exist
- Check browser console for asset loading errors

### Database Connection Issues
- Verify database environment variables
- Check database is in same region as web service
- Use Internal Database URL (not External)

## Updating Your Deployment

1. Make changes locally
2. Test locally
3. Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Your update message"
   git push origin main
   ```
4. Render will automatically detect changes and redeploy

## Manual Redeploy

If needed, you can manually trigger a redeploy:
1. Go to your service in Render dashboard
2. Click **"Manual Deploy"** → **"Deploy latest commit"**

## Cost Notes

- **Free Tier**: Includes 750 hours/month (enough for 1 service running 24/7)
- **Starter Plan**: $7/month per service (no sleep, better performance)
- **Database**: Free tier available (90 days, then $7/month)

## Support

- Render Docs: https://render.com/docs
- Render Community: https://community.render.com

