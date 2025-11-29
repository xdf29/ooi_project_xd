import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const src = path.join(__dirname, 'public', 'dist', '.vite', 'manifest.json');
const dest = path.join(__dirname, 'public', 'dist', 'manifest.json');

if (fs.existsSync(src)) {
    fs.renameSync(src, dest);
    console.log('✓ Manifest moved to public/dist/manifest.json');
} else {
    console.log('⚠ Manifest not found in .vite folder');
}

