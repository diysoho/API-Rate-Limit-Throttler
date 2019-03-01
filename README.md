# API-Rate-Limit-Throttler
This PHP script will help you to throttle and limit users requests to your API.This code uses sessions to identify and block users who exceed API requests for a given time.

# Usage
This script have 2 functions : limit() and unset()

# Require script in your API
``` php
<?php
require_once ('api_limit.php');
?>
```
# Create Instance of the class
``` php
<?php
require_once ('api_limit.php');

$ApiLimit = new ApiLimit();
?>
```

# Example limit()
For example you want to limit users to 100 requests / minute , so you should add this php code in your API
``` php
require_once ('api_limit.php');

$ApiLimit = new ApiLimit();

$ApiLimit->limit('100','60');

```
This simple code will limit user from accessing API if user made 100 requests in 1 minute.

# Example unset()
This function will reset all users requests to 0
``` php
require_once ('api_limit.php');

$ApiLimit = new ApiLimit();

$ApiLimit->unset();

```

# If you find this repository helpful share it and give a star to it.

This code can be improved so if you have time please help to make it better.
