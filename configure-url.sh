#!/bin/bash

# Laravel Project URL Configuration Script
# This script helps configure the correct URL for your Laravel project

echo "=================================="
echo "Laravel URL Configuration Helper"
echo "=================================="

# Default values
DEFAULT_URL="http://localhost:8000"
CURRENT_URL=$(grep APP_URL .env | cut -d '=' -f2)

echo "Current APP_URL: $CURRENT_URL"
echo ""
echo "How are you running your Laravel project?"
echo "1. php artisan serve (default port 8000)"
echo "2. php artisan serve --port=XXXX (custom port)"
echo "3. Apache/Nginx with virtual host"
echo "4. XAMPP/WAMP/MAMP"
echo "5. Docker"
echo "6. Other/Custom URL"

read -p "Select option (1-6): " OPTION

case $OPTION in
    1)
        NEW_URL="http://localhost:8000"
        ;;
    2)
        read -p "Enter port number: " PORT
        NEW_URL="http://localhost:$PORT"
        ;;
    3)
        read -p "Enter your domain (e.g., jewellery.local): " DOMAIN
        read -p "Use HTTPS? (y/n): " USE_HTTPS
        if [ "$USE_HTTPS" = "y" ]; then
            NEW_URL="https://$DOMAIN"
        else
            NEW_URL="http://$DOMAIN"
        fi
        ;;
    4)
        read -p "Enter project path (e.g., localhost/jewellery): " PATH
        NEW_URL="http://$PATH"
        ;;
    5)
        read -p "Enter Docker host and port (e.g., localhost:8080): " DOCKER_HOST
        NEW_URL="http://$DOCKER_HOST"
        ;;
    6)
        read -p "Enter complete URL (e.g., http://example.com): " NEW_URL
        ;;
    *)
        echo "Invalid option. Using default."
        NEW_URL=$DEFAULT_URL
        ;;
esac

# Update .env file
if [ -f .env ]; then
    # Backup current .env
    cp .env .env.backup.$(date +%Y%m%d_%H%M%S)
    
    # Update APP_URL
    if grep -q "APP_URL=" .env; then
        sed -i "s|APP_URL=.*|APP_URL=$NEW_URL|" .env
    else
        echo "APP_URL=$NEW_URL" >> .env
    fi
    
    echo ""
    echo "✅ Updated APP_URL to: $NEW_URL"
    echo "✅ Backup created: .env.backup.$(date +%Y%m%d_%H%M%S)"
else
    echo "❌ Error: .env file not found!"
    exit 1
fi

# Clear Laravel caches
echo ""
echo "Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo ""
echo "=================================="
echo "Configuration completed!"
echo "Your application URL is now: $NEW_URL"
echo ""
echo "Important notes:"
echo "1. Make sure your web server is configured correctly"
echo "2. If using virtual host, update your hosts file"
echo "3. Images should now display correctly"
echo "4. If images still don't show, check:"
echo "   - File permissions on public/product_image/"
echo "   - Storage link (php artisan storage:link)"
echo "=================================="