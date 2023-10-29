#!/bin/bash

# Variable for storing the path to the Hosts file
hosts_file=""

# Operating System Definition
if [[ "$OSTYPE" == "linux-gnu"* ]]; then
    # Linux
    hosts_file="/etc/hosts"
elif [[ "$OSTYPE" == "darwin"* ]]; then
    # macOS
    hosts_file="/private/etc/hosts"
elif [[ "$OSTYPE" == "msys" || "$OSTYPE" == "cygwin" ]]; then
    # Windows (Git Bash, Cygwin)
    hosts_file="/c/Windows/System32/drivers/etc/hosts"
else
    echo "The operating system could not be determined."
    exit 1
fi

# Desired domains and their corresponding IP addresses
domains=("shop.local" "api.shop.local")
ip="127.0.0.1"

# Checking for domain records and adding them if they don't exist
for domain in "${domains[@]}"; do
    if grep -q "$ip $domain" "$hosts_file"; then
        echo "An entry for $domain already exists in the hosts file."
    else
        echo "$ip $domain" >> "$hosts_file"
        echo "Added an entry for $domain to the hosts file."
    fi
done

# Reboot the network service to apply changes (works on most systems)
if [[ "$OSTYPE" == "linux-gnu"* || "$OSTYPE" == "darwin"* ]]; then
    if [[ "$OSTYPE" == "linux-gnu"* ]]; then
        service network-manager restart
    elif [[ "$OSTYPE" == "darwin"* ]]; then
        dscacheutil -flushcache
    fi
fi

# For Windows, run the command to update the DNS cache
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "cygwin" ]]; then
    ipconfig /flushdns
fi

echo "Ready! Domains have been added to the hosts file ($hosts_file)."

exec "$@"
