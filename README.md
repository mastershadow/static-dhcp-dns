# static-dhcp-dns
Static DHCP DNS editor for dhcpd and unbound on FreeBSD (probably ok on other *nix-like OSes)

Made with love by Eduard Roccatello. We are actually using this at [3DGIS](https://www.3dgis.it)!

![Static DHCP DNS Editor](http://i.imgur.com/2M8NWSi.png)

Based on PHP and MYSQL.

## Install
* Configure apache to point to public folder (as alias or vhost. htaccess is needed so if you use nginx just create the appropriate rules)
* Create mysql database
* Create config.php
* Launch composer
* Launch bower
* Give write permission to OUTDIR

## Warning
This only creates files. You have to import them / copy them using whathever you like (cron script, manual commands, etc).

### Example copy script
```
#!/bin/sh

DHCP_SRC=/usr/local/www/apache24/static-dhcp-dns/out/dhcp-static.conf
DHCP_DST=/usr/local/etc/dhcp-static.conf
DNS_SRC=/usr/local/www/apache24/static-dhcp-dns/out/dns-hosts.conf
DNS_DST=/usr/local/etc/unbound/dns-hosts.conf

diff $DHCP_SRC $DHCP_DST > /dev/null 2>&1
if [ $? -eq 1 ] ; then
        cp $DHCP_SRC $DHCP_DST;
        service isc-dhcpd restart;
fi

diff $DNS_SRC $DNS_DST > /dev/null 2>&1
if [ $? -eq 1 ] ; then
        cp $DNS_SRC $DNS_DST;
        service unbound restart;
fi
```
