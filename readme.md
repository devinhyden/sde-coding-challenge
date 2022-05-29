# SDE Coding Challenge

PHP script to calculate the highest suitability score based on secret formula.

| :exclamation:  Minimum PHP version 7.4 |
|----------------------------------------|

# Executing
1. Clone this repo.
2. Navigate to folder containing downloaded repo
3. Replace or copy address and driver text files into `/src` folder.
4. Execute using [Docker](#docker) or [PHP](#php).
   1. File name is passed at runtime via parameters and can be modified to fit needs.

## Docker
```
docker container run --rm -v $(pwd):/app/ php:8.1-cli php /app/src/calculate_suitability_score.php addresses.txt drivers.txt
```

## PHP
| :warning: WARNING                                          |
|:-----------------------------------------------------------|
| PHP must be installed locally on machine executing script. |

```
php src/calculate_suitability_score.php addresses.txt drivers.txt
```


# Output
Total suitability score and a matching between shipment destinations and drivers
```
24
10
7
4
3
```