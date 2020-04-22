# Drop_DisableUnusefulLog
- Disables writing to log files for certain types of messages
- Writes the backtrace of an observed message to the log file

## Installation
- Install module through composer (recommended):
```sh
$ composer config repositories.drop.dul vcs https://github.com/Dropsrl/Drop_DisableUnusefulLog
$ composer require drop/module-disable-unuseful-log
```

- Install module manually:
    - Copy these files in app/code/Drop/Drop_DisableUnusefulLog/

- After installing the extension, run the following commands:
```sh
$ php bin/magento module:enable Drop_DisableUnusefulLog
$ php bin/magento setup:upgrade
$ php bin/magento setup:di:compile
$ php bin/magento setup:static-content:deploy
$ php bin/magento cache:clear
```

## Requirements
- PHP >= 7.0.0

## Compatibility
- Magento >= 2.2
- Not tested on 2.1 and 2.0

## Support
If you encounter any problems or bugs, please create an issue on [Github](https://github.com/Dropsrl/Drop_DisableUnusefulLog/issues) 

## License
[GNU General Public License, version 3 (GPLv3)] http://opensource.org/licenses/gpl-3.0

## Copyright
(C) 2019 Drop S.R.L.
