# twitter-php-api
Simple PHP application used to interact with the official Twitter API

<div id="top"></div>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/muckee/twitter-php-api">
    <img src="images/logo.png" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">twitter-php-api</h3>

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

[![Product Name Screen Shot][product-screenshot]](https://example.com)

A simple PHP application to allow interaction with the official Twitter API. This is a general purpose package, although it was intended for use by bots created with the Discord.js package.

<p align="right">(<a href="#top">back to top</a>)</p>



### Built With

* [Composer](https://getcomposer.org/)
* [NGINX](https://nginx.org/)
* [Slim](https://www.slimframework.com/)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

Please ensure that you follow these instructions carefully and refer to third-party documentation where necessary.

### Prerequisites

#### Install and configure NGINX
##### Linux
>`$ sudo apt install nginx`

>`$ sudo cp /etc/nginx/sites-available/default /etc/nginx/sites-available/twitter-php-api`

>`$ sudo nano /etc/nginx/sites-available/twitter-php-api`

>This file must be edited according to the configuration of your specific environment.
>General NGINX documentation can be found here: [https://nginx.org/en/docs/](https://nginx.org/en/docs/)
>You should configure your server according to Slim's recommendations, found here: [https://www.slimframework.com/docs/v4/start/web-servers.html](https://www.slimframework.com/docs/v4/start/web-servers.html)

>Once configured, the settings can be applied by issuing the following commands

>`$ sudo ln -sf /etc/nginx/sites-available/twitter-php-api /etc/nginx/sites-enabled/`

>`$ sudo systemctl restart nginx`

#### Install PHP
>##### Linux
>`$ sudo apt install php7.4-cli`

>##### Windows
>Follow instructions here: https://www.php.net/manual/en/install.windows.php

#### Install necessary packages and PHP extensions
>##### Linux
```
$ sudo apt install openssl curl unzip php-curl php-dom php-mbstring php-soap php-xdebug
```

#### Install the latest version of Composer and add to PATH configuration.
>Instructions can be found here: [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md)


### Installation

1. Navigate to home directory and clone this repo
   ```sh
   $ cd
   $ git clone https://github.com/muckee/twitter-php-api.git
   ```
3. Navigate into project folder and install using Composer
   ```sh
   $ cd twitter-php-api
   $ composer install
   ```
3. Test the application by visiting the URL that you supplied in your nginx configuration file. If you are running on localhost and would like to use a FQDN in your NGINX file, you can edit your machine's hosts file to access the application via the FQDN in your browser.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.

_For more examples, please refer to the [Documentation](https://example.com)_

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- ROADMAP -->
## Roadmap

- [] Feature 1
- [] Feature 2
- [] Feature 3
    - [] Nested Feature

See the [open issues](https://github.com/github_username/repo_name/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Your Name - [@twitter_handle](https://twitter.com/twitter_handle) - email@email_client.com

Project Link: [https://github.com/github_username/repo_name](https://github.com/github_username/repo_name)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

* []()
* []()
* []()

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/github_username/repo_name.svg?style=for-the-badge
[contributors-url]: https://github.com/github_username/repo_name/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/github_username/repo_name.svg?style=for-the-badge
[forks-url]: https://github.com/github_username/repo_name/network/members
[stars-shield]: https://img.shields.io/github/stars/github_username/repo_name.svg?style=for-the-badge
[stars-url]: https://github.com/github_username/repo_name/stargazers
[issues-shield]: https://img.shields.io/github/issues/github_username/repo_name.svg?style=for-the-badge
[issues-url]: https://github.com/github_username/repo_name/issues
[license-shield]: https://img.shields.io/github/license/github_username/repo_name.svg?style=for-the-badge
[license-url]: https://github.com/github_username/repo_name/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/linkedin_username
[product-screenshot]: images/screenshot.png
