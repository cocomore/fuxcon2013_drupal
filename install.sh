#!/bin/bash

cat <<EOS
Welcome to the installation of the Drupal version of the project site for the FUxCon 2013 workshop.

This software and documentation is released under the GNU General Public License 
(version 3). Please review the license in LICENSE.txt.

This script will download and setup Drupal and all the required modules,
will then merge our code into it and will finally load the database. 
It assumes that you have created a MySQL database "fuxcon2013_drupal" 
and a database user "fuxcon" with password "fuxcon" for it. 

If you still need to do this, please press ^C now 
and restart the installation once you are ready.

EOS

read -p "Ready to proceed? [y]/n " reply
if [ "x$reply" != "x" -a "x$reply" != "xy" ]
then
  echo "Please type \"y\" or simply press ENTER to proceed with the installation"
  exit
fi

echo "Loading Drupal ..."
drush dl --drupal-project-rename=drupal drupal-7

echo "Merging custom code ..."
tar cf - sites | (cd drupal; tar xf -)

echo "Loading required modules ..."
drush --root=`pwd`/drupal dl \
  ctools devel features markdown views \
  date devel_themer jquery_update simplehtmldom

echo "Loading database ..."
gunzip < fuxcon2013_drupal.sql.gz | mysql -ufuxcon -pfuxcon fuxcon2013_drupal

echo "Setting permissions (requires root access) ..."
sys=`uname -s`
if [ $sys = Darvin ]
then
  sudo chmod +a "www allow delete,write,append,file_inherit,directory_inherit" drupal/sites/default/files
  sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" drupal/sites/default/files
else
  sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX drupal/sites/default/files
  sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx drupal/sites/default/files
fi
echo "Done."
