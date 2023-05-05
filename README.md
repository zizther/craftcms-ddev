A Craft CMS starter project using DDEV for local hosting and Vite for front-end bundling and HMR.

> Going from zero to Vite HMR on a fresh Craft install, with only 4 CLI commands:  
> 1. `composer create-project...`
> 2. `make init`
> 3. `make setup`
> 4. `make dev`

## Notable Features:

- [DDEV](https://ddev.readthedocs.io/) for local development
- [Vite 2.x](https://vitejs.dev/) for front-end bundling & HMR
- [Tailwind 3.x](https://tailwindcss.com) for utility-first CSS
- [Alpine 3.x](https://alpinejs.dev/) for lightweight reactivity
- [Makefile](https://www.gnu.org/software/make/manual/make.html) for common CLI commands

## Local machine prerequisites:

1. [Docker](https://www.docker.com/)
2. [DDEV](https://ddev.readthedocs.io/), minimum version 1.19
3. Optional, but recommended, [Composer](https://getcomposer.org/)

## Getting Started

### Option 1: With Composer (recommended)

If you have [Composer](https://getcomposer.org/) installed on your local machine,
you can use `create-project` to pull the latest tagged release.

Open terminal prompt, and run:

```shell
composer create-project zizther/craftcms-ddev PATH --no-install
```

Make sure that `PATH` is a **new** or **existing and empty** folder.

### Option 2: With Git CLI

Alternatively you can clone the repo via the Git CLI. [degit](https://github.com/Rich-Harris/degit) is the easiest way:

```shell
degit git@github.com:zizther/craftcms-ddev.git PATH
```

Make sure that `PATH` is a **new** _or_ **existing and empty** folder.

Last, clean up and set some default files for use:

```shell
make init
```

#### If you are using `git clone`
You'll want to discard the existing `/.git` directory. In the terminal, run:

```shell
cd PATH
rm -rf .git
```

### Option 3: Manual Download

Download a copy of the repo to your local machine and move to where you want to your project to run. Similar to above, you'll then want to clean up and set some default files for use. In the terminal, run:

```shell
make init
```

## Configuring DDEV

_Note: This section is optional. If you are simply test-driving this project, feel free to skip to the next section. ⚡_

To configure your project to operate on a domain other than `https://craftcms.test`, run:

```shell
ddev config
```

Follow the prompts.

- **Project name:** e.g. `mysite` would result in a project URL of `https://mysite.test` (make note of this for later in the installation process)
- **Docroot location:** defaults to `web`, keep as-is
- **Project Type:** defaults to `php`, keep as-is

## Installing Craft

To install a clean version of Craft, run:

```shell
make setup
```

Follow the prompts.

This command will:

1. Set the project name and domain
2. Copy your local SSH keys into the container (handy if you are setting up [craft-scripts](https://github.com/nystudio107/craft-scripts/))
3. Start your DDEV project
4. Install Composer
5. Install npm
6. Do a one-time build of Vite
7. Generate `CRAFT_APP_ID` and save to your `.env` file
8. Generate `CRAFT_SECURITY_KEY` and save to your `.env` file
9. Installing Craft for the first time, allowing you to set the admin's account credentials
10. Install some of the Craft plugins

Once the process is complete, type `ddev launch` to open the project in your default browser. 🚀

## Local development with Vite

To begin development with Vite's dev server & HMR, run:

```shell
make dev
```

This command will:

1. Copy your local SSH keys into the container (handy if you are setting up [craft-scripts](https://github.com/nystudio107/craft-scripts/))
2. Start your DDEV project
3. Install Composer
4. Install npm
5. Do a one-time build of Vite
6. Spin up the Vite dev server

Open up a browser to your project domain to verify that Vite is connected. Begin crafting beautiful things. ❤️

## Makefile

A Makefile has been included to provide a unified CLI for common development commands.

- `make install` - Runs a complete one-time process to set the project up and install Craft.
- `make up` - Starts the DDEV project, ensuring that SSH keys have been added, and npm & Composer have been installed.
- `make dev` - Runs a one-time build of all front-end assets, then starts Vite's server for HMR.
- `make build` - Builds all front-end assets.
- `make composer xxx` - Run Composer commands inside the container, e.g. `make composer install`
- `make craft xxx` - Run Craft commands inside the container, e.g. `make craft project-config/touch`
- `make npm xxx` - Run npm commands inside the container, e.g. `make npm install`
- `make clean` - Removes the `composer.lock`, `package-lock.json` and the entire `node_modules` & `vendor` directory
- `make nuke` - Restarts the project from scratch by running `make clean` (above), then reinstalls composer and node packages
- `make pull` - Pull remote db & assets (requires setting up [craft-scripts](https://github.com/nystudio107/craft-scripts/)

**Tip**: If you try a command like `make craft project-config/apply --force` you’ll see an error, because the shell thinks the `--force` flag should be applied to the `make` command. To side-step this, use the `--` (double-dash) to disable further option processing, like this: `make -- craft project-config/apply --force`

## Craft CMS Plugins

1. [AWS S3](https://plugins.craftcms.com/aws-s3?craft4)
2. [CKEditor](https://plugins.craftcms.com/ckeditor?craft4)
3. [CP Clear Cache](https://plugins.craftcms.com/cp-clearcache?craft4)
4. [CP Field Inspect](https://plugins.craftcms.com/cp-field-inspect?craft4)
5. [Cookies](https://plugins.craftcms.com/cookies?craft4)
6. [Craft Autocomplete](https://github.com/nystudio107/craft-autocomplete)
7. [Hyper](https://plugins.craftcms.com/hyper?craft4)
8. [Navigation](https://plugins.craftcms.com/navigation?craft4)
9. [Neo](https://plugins.craftcms.com/neo?craft4)
10. [Quick Field](https://plugins.craftcms.com/quick-field?craft4)
11. [Ray](https://plugins.craftcms.com/craft-ray?craft4)
12. [Retour](https://plugins.craftcms.com/retour?craft4)
13. [SEOmatic](https://plugins.craftcms.com/seomatic?craft4)
14. [Vite](https://plugins.craftcms.com/vite?craft4)

## Javascript Libraries

1. [Alpine](https://alpinejs.dev/)
2. [Body Scroll Locking](https://github.com/willmcpo/body-scroll-lock)
3. [Splide](https://splidejs.com/)
4. [GSAP](https://greensock.com/gsap/)
5. [Quicklink](https://getquick.link/)
6. [Reframe](https://dollarshaveclub.github.io/reframe.js/)
7. [Vanilla Lazyload](https://github.com/verlok/vanilla-lazyload)

## Kudos
Thanks to Andrew (nystudio107) and johndwells for the inspiration 
