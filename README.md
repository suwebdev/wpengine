# NCS WP Engine Deployed Code

This repository is the code that is deployed to WP Engine. It ignores the Wordpress Core files, so you will have to get Wordpress installed (http://wordpress.org) into the same directory to get it running locally.

## Managing Submodules

Custom components of this site are created as themes and plugins. These are stored in separate repositories and brought into the production code using Git submodules. If you are installing the project for the first time, run the following commands to initialize and update the submodules:

```
git submodule init
git submodule update
```

After you have initialized the submodules, you can update the code in the submodules at any time by running `git submodule update` from the root directory of the project.

## Deployed locations

This code is deployed at the following locations:

[Staging Server](http://suncs.staging.wpengine.com)

[Production Server](http://suncs.wpengine.com)

