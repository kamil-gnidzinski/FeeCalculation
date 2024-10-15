Interview Test - Fee Calculation
=====
by Kamil Gnidziński
=====
# Installation
After pulling this repository run following comand in main directory:
```bash
docker compose up --build
```
When the build is completed execute:

```bash
docker exec -it kg_recruitment /bin/bash
```
Run following command to run the app with sample data

```bash
php main.php
```

If you want to run test cases execute:

```bash
vendor/bin/phpunit  --color='always'
```

# Notes

I was thinking about using Money library to ensure 
that app is open for usage of other currencies,  
but decided that 
this will be a little bit overengineering since it's only interview app.  
Since database wasn't required for this test I decided to store fee 
structure data in JSON files
