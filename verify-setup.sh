#!/bin/bash

# Verification script to check if all dependencies are installed correctly

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Laravel Project Setup Verification${NC}"
echo -e "${GREEN}========================================${NC}"

ERRORS=0

# Check PHP version
echo -e "\n${YELLOW}Checking PHP...${NC}"
if command -v php &> /dev/null; then
    PHP_VERSION=$(php -r "echo PHP_VERSION;")
    if [[ $PHP_VERSION == 8.1.* ]] || [[ $PHP_VERSION == 8.2.* ]] || [[ $PHP_VERSION == 8.3.* ]]; then
        echo -e "${GREEN}✓ PHP $PHP_VERSION installed${NC}"
    else
        echo -e "${RED}✗ PHP 8.1+ required, found $PHP_VERSION${NC}"
        ERRORS=$((ERRORS + 1))
    fi
else
    echo -e "${RED}✗ PHP not installed${NC}"
    ERRORS=$((ERRORS + 1))
fi

# Check PHP extensions
echo -e "\n${YELLOW}Checking PHP extensions...${NC}"
REQUIRED_EXTENSIONS=("mbstring" "xml" "curl" "openssl" "pdo" "pdo_mysql" "json" "tokenizer" "ctype" "filter" "hash" "session")
for ext in "${REQUIRED_EXTENSIONS[@]}"; do
    if php -m | grep -q "^$ext$"; then
        echo -e "${GREEN}✓ PHP extension '$ext' installed${NC}"
    else
        echo -e "${RED}✗ PHP extension '$ext' missing${NC}"
        ERRORS=$((ERRORS + 1))
    fi
done

# Check Composer
echo -e "\n${YELLOW}Checking Composer...${NC}"
if command -v composer &> /dev/null; then
    echo -e "${GREEN}✓ Composer $(composer --version --no-ansi | grep -oE '[0-9]+\.[0-9]+\.[0-9]+' | head -1) installed${NC}"
else
    echo -e "${RED}✗ Composer not installed${NC}"
    ERRORS=$((ERRORS + 1))
fi

# Check Node.js and npm
echo -e "\n${YELLOW}Checking Node.js and npm...${NC}"
if command -v node &> /dev/null; then
    echo -e "${GREEN}✓ Node.js $(node --version) installed${NC}"
else
    echo -e "${RED}✗ Node.js not installed${NC}"
    ERRORS=$((ERRORS + 1))
fi

if command -v npm &> /dev/null; then
    echo -e "${GREEN}✓ npm $(npm --version) installed${NC}"
else
    echo -e "${RED}✗ npm not installed${NC}"
    ERRORS=$((ERRORS + 1))
fi

# Check MySQL
echo -e "\n${YELLOW}Checking MySQL...${NC}"
if systemctl is-active --quiet mysql; then
    echo -e "${GREEN}✓ MySQL is running${NC}"
else
    echo -e "${RED}✗ MySQL is not running${NC}"
    ERRORS=$((ERRORS + 1))
fi

# Check Apache
echo -e "\n${YELLOW}Checking Apache...${NC}"
if systemctl is-active --quiet apache2; then
    echo -e "${GREEN}✓ Apache is running${NC}"
else
    echo -e "${RED}✗ Apache is not running${NC}"
    ERRORS=$((ERRORS + 1))
fi

# Check Laravel project files
echo -e "\n${YELLOW}Checking Laravel project files...${NC}"
if [ -f ".env" ]; then
    echo -e "${GREEN}✓ .env file exists${NC}"
else
    echo -e "${RED}✗ .env file missing${NC}"
    ERRORS=$((ERRORS + 1))
fi

if [ -d "vendor" ]; then
    echo -e "${GREEN}✓ Composer dependencies installed${NC}"
else
    echo -e "${RED}✗ Composer dependencies not installed${NC}"
    ERRORS=$((ERRORS + 1))
fi

if [ -d "node_modules" ]; then
    echo -e "${GREEN}✓ npm dependencies installed${NC}"
else
    echo -e "${RED}✗ npm dependencies not installed${NC}"
    ERRORS=$((ERRORS + 1))
fi

if [ -L "public/storage" ]; then
    echo -e "${GREEN}✓ Storage link exists${NC}"
else
    echo -e "${YELLOW}! Storage link missing (run: php artisan storage:link)${NC}"
fi

# Summary
echo -e "\n${GREEN}========================================${NC}"
if [ $ERRORS -eq 0 ]; then
    echo -e "${GREEN}All checks passed! Your environment is ready.${NC}"
    echo -e "\n${YELLOW}You can now run:${NC}"
    echo -e "1. ${GREEN}./setup-laravel-project.sh${NC} - To complete the setup"
    echo -e "2. ${GREEN}php artisan serve${NC} - To start the development server"
    echo -e "3. ${GREEN}npm run dev${NC} - To start Vite dev server (in another terminal)"
else
    echo -e "${RED}$ERRORS issues found. Please install missing dependencies.${NC}"
    echo -e "\n${YELLOW}Run the setup script to install all dependencies:${NC}"
    echo -e "${GREEN}./setup-laravel-project.sh${NC}"
fi
echo -e "${GREEN}========================================${NC}"