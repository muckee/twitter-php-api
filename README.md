# twitter-php-api
Simple PHP application for interacting with the official Twitter API

<div id="top"></div>

<!-- PROJECT SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">

  <h3 align="center">Twitter PHP API</h3>

  <p align="center">
    project_description
    <br />
    <a href="https://github.com/muckee/twitter-php-api"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/muckee/twitter-php-api">View Demo</a>
    ·
    <a href="https://github.com/muckee/twitter-php-api/issues">Report Bug</a>
    ·
    <a href="https://github.com/muckee/twitter-php-api/issues">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

A simple PHP application to allow interaction with the official Twitter API. This package was designed to function as an interface between the Twitter API and bots created with the Discord.js package, though it can be implemented as a general-purpose Twitter API.

<p align="right">(<a href="#top">back to top</a>)</p>



### Built With

* [Composer](https://getcomposer.org/)
* [Slim](https://www.slimframework.com/)
* [Twitter API](https://developer.twitter.com/)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

Please ensure that you follow these instructions carefully and refer to third-party documentation where necessary.

### Prerequisites

### Gain elevated access to the Twitter API
In order to acquire the credentials required to utilise the Twitter API, please visit the [Twitter Developer Portal](https://developer.twitter.com/). Here you can create an account, register a project and create an app. During this process you will be provided with the various keys needed to interact with the API - be sure to read all the prompts carefully and store your credentials securely.

In addition to the credentials provided during app configuration, it is necessary to create an access token/secret pair from within the settings section of your app within the Developer Portal.

The credentials required to make use of this package are: OAuth Token (also called 'Consumer Token'), OAuth Token Secret (also called 'Consumer Token Secret'), Access Token, Access Token Secret

#### Install and configure NGINX (or any other HTTP server)
##### Linux
>`$ sudo apt install nginx`

>`$ sudo cp /etc/nginx/sites-available/default /etc/nginx/sites-available/twitter-php-api`

>`$ sudo nano /etc/nginx/sites-available/twitter-php-api`

>This file must be edited according to the configuration of your specific environment.
>General NGINX documentation can be found here: [https://nginx.org/en/docs/](https://nginx.org/en/docs/)
>You should configure your server according to Slim's recommendations, found here: [https://www.slimframework.com/docs/v4/start/web-servers.html](https://www.slimframework.com/docs/v4/start/web-servers.html)

>Once configured, the settings can be applied by issuing the following commands

>`$ sudo ln -sf /etc/nginx/sites-available/twitter-php-api /etc/nginx/sites-enabled/`

>`$ sudo service nginx restart`

#### Install PHP
>##### Linux
>`$ sudo apt install php7.4-cli`

>##### Windows
>Follow instructions here: https://www.php.net/manual/en/install.windows.php

#### Install necessary packages and PHP extensions
>##### Linux
>`$ sudo apt install openssl curl unzip php-curl php-dom php-mbstring php-soap php-xdebug`

#### Install the latest version of Composer and add to PATH configuration.
>Instructions for installing Composer can be found here: [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md).

>Ensure that you follow the full instructions to install Composer globally.

### Installation

1. Navigate to home directory and clone this repo
   ```sh
   $ cd
   $ git clone https://github.com/muckee/twitter-php-api.git
   ```
2. Navigate into project folder and install using Composer
   ```sh
   $ cd twitter-php-api
   $ composer install
   ```
3. Create a new `.env` file (or copy the sample file) and store the credentials you received from the Twitter API in this file.
   ```sh
   $ cp .env.sample .env
   $ nano .env
   ```
**NOTE: Please research the most secure way to upload these credentials to your production server. Entry via the command-line is only suitable in a local, development environment**

4. Create a symbolic link to the package in the `var/www/` folder
   ```
   $ sudo ln -sf /home/$USER/twitter-php-api /var/www/
   ```

5. Test the application by visiting the URL that you supplied in your nginx configuration file. If you are running on localhost and would like to use a FQDN in your NGINX file, you can edit your machine's hosts file to access the application via the FQDN in your browser. Alternatively, for rapid testing in a development environment, execute the command `$ composer start` from the project's root directory.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage
Note that the attributes of each end point are limitations defined by the Twitter API itself and cannot be altered. This list will be updated as more endpoints are supported by the package.

| Endpoints      |  Rate Limit      | Tweet Cap | Special Attributes |
|:---------------|:----------------:|:---------:|--------------------|
| POST /2/tweets | 200/15 mins/user | no        |-                   |

*** Update the following line in production
*** _For more examples, please refer to the [Documentation](https://example.com)_

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- ROADMAP -->
## Roadmap

- [] Finish adding 'tweets' endpoints
- [] Add 'users' endpoints
- [] Add remaining endpoints

See the [open issues](https://github.com/muckee/twitter-php-api/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Please see '[CONTRIBUTING](https://github.com/muckee/twitter-php-api/blob/main/CONTRIBUTING.md)' for details.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Your Name - [@muckee_eth](https://twitter.com/muckee_eth) - info@joshuaflood.com

Project Link: [https://github.com/muckee/twitter-php-api](https://github.com/muckee/twitter-php-api)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

* []()
* []()
* []()

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/muckee/twitter-php-api.svg?style=for-the-badge
[contributors-url]: https://github.com/muckee/twitter-php-api/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/muckee/twitter-php-api.svg?style=for-the-badge
[forks-url]: https://github.com/muckee/twitter-php-api/network/members
[stars-shield]: https://img.shields.io/github/stars/muckee/twitter-php-api.svg?style=for-the-badge
[stars-url]: https://github.com/muckee/twitter-php-api/stargazers
[issues-shield]: https://img.shields.io/github/issues/muckee/twitter-php-api.svg?style=for-the-badge
[issues-url]: https://github.com/muckee/twitter-php-api/issues
[license-shield]: https://img.shields.io/github/license/muckee/twitter-php-api.svg?style=for-the-badge
[license-url]: https://github.com/muckee/twitter-php-api/blob/master/LICENSE.txt
[product-screenshot]: images/screenshot.png
