# Question API
A Laravel Crud Question application. 

## Technologies Used
- php 7.4
- mysql 5.7
- Nginx:latest

## Local environment setup

1. Make a copy of `.env-example` and rename to `.env` and edit the variables accordingly.
2. from the project root directory, cd into `.docker` folder.
3. run the command `docker-composer up -d`
4. to run database migration, use the command `docker exec php php /var/www/html/artisan migrate`.

## API Documentation

| HTTP Verb | Path | Parameters | Payload  | Used for |
| --------- | ---- | ---------- | -------- | -------- |
| GET       | `/api/v1/questions` | - | - | Get a list of all questions |
| GET       | `/api/v1/questions/{question}/` | **question**: question id | Get details of a single question |
| POST      | `/api/v1/questions` | - | **question_file**: .xlsx, .csv files are supported | Upload a spreadsheet file of questions |
| PUT       | `/api/v1/questions/{question}` | **question**: the id of the question | **question**: *required, string* <br>**is_general**: *required, boolean*<br>**categories**: *not required, string*<br>**point**: *required, integer*<br>**icon_url**: *not required, string* must be a valid url<br>**duration**: *required, integer* | Update a question |
| DELETE    | `/api/v1/questions/{question}` | **question**: the id of the question | - | Delete a question |
| POST      | `/api/v1/questions/{question}/choices` | **question**: question id | **description**: *required, string*<br>**is_correct_choice**: *required, boolean*<br>**icon_url**: *string* | Create a choice for a question |
| PUT | `/api/v1/choices/{choice}` | **choice**: choice id | **description**: *required, string*<br>**is_correct_choice**: *required, boolean*<br>**icon_url**: *string* | Update a choice |
| DELETE | `/api/v1/choices/{choice}` | **choice**: choice id | - | Delete a choice from the database |

## Testing

To run tests, run the command `php artisan test`
