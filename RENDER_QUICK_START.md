# Quick Start Checklist for Render Deployment

## Before You Deploy

- [ ] Code is pushed to GitHub
- [ ] Generated `APP_KEY` (run: `php artisan key:generate --show`)
- [ ] Have a Render account (sign up at render.com)

## Deployment Steps

1. **Go to Render Dashboard** → Click "New +" → "Web Service"

2. **Connect Repository**
   - Connect GitHub account (if not already)
   - Select your `ooi_project` repository
   - Click "Connect"

3. **Configure Service**
   - Name: `ooi-project`
   - Region: Choose closest to you
   - Branch: `main`
   - Runtime: **Docker** (important!)
   - Build/Start commands: Leave empty

4. **Set Environment Variables** (in Environment tab):
   ```
   APP_NAME=Laravel
   APP_ENV=production
   APP_KEY=<paste your generated key>
   APP_DEBUG=false
   APP_URL=https://ooi-project.onrender.com
   LOG_CHANNEL=stack
   LOG_LEVEL=error
   CACHE_DRIVER=file
   SESSION_DRIVER=file
   QUEUE_CONNECTION=sync
   FILESYSTEM_DISK=local
   ```

5. **Deploy**
   - Click "Create Web Service"
   - Wait 5-10 minutes for build
   - Your site will be live at: `https://ooi-project.onrender.com`

## Important Notes

- **Free tier**: Services sleep after 15 minutes of inactivity
- **First deploy**: May take longer (10-15 minutes)
- **Subsequent deploys**: Automatic when you push to GitHub
- **Update APP_URL**: After deployment, update `APP_URL` to your actual Render URL

## Need Help?

See `DEPLOYMENT.md` for detailed instructions and troubleshooting.

