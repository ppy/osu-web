# Code Standards

- For PHP, we adhere to [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and this will be enforced by StyleCI.
- For CSS, we use the [BEM](http://getbem.com/) conventions.

# React vs Laravel Blades

Previously, using React was generally preferred for pages which involved interaction beyond simple hyperlinks (ie. when state is present that can be modified by the user) or when real-time changes were presented to the user (ie. the state is volatile and dependant on back-end updates). Otherwise Laravel Blades were used instead.

However, we have since decided to move towards providing all data from Laravel as JSON and using React to consume this and perform rendering instead. The goal is to help ensure that there will a consistent data interface being used (i.e. the data/JSON is identical for what React uses and what the game client will be using via the API).
