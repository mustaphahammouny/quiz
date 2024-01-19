Assignment Blueprint for backend
===============================

This is a Laravel blueprint for backend development, for creating a multi-tenant application **(single database)** to manage quizzes

## Installation
- clone this repository `git clone git@github.com:mustaphahammouny/quiz.git`
- cd into the project directory `cd quiz`
- run `composer install`
- run `npm install`
- run `cp .env.example .env`
- run migration and seeders `php artisan migrate --seed`
- serve the application `php artisan serve` or use laravel valet, or any other server
- run `npm run dev`
- visit the application in your browser `http://localhost:8000`

## APIs
- Auth:
    endpoit: /api/login
    params : 
      email: string,
      password: string
    response: 
      token to use to access other apis

- Get all quizzes:
    endpoint: /quizzes
    response: array of quizzes

- Get signle quiz:
    endpoint: /quiz/{quiz_id}
    response: object of quiz

- Get all questions by quiz:
    endpoint: /quizzes/{quiz_id}/questions
    response: array of questions

- Get signle question:
    endpoint: /question/{question_id}
    response: object of question

- Get all choices by question:
    endpoint: /questions/{question_id}/choices
    response: array of choices

- Get signle choice:
    endpoint: /choice/{choice_id}
    response: object of choice

- Get all attempts:
    endpoint: /attempts
    response: array of attempts

- Get signle attempts:
    endpoint: /attempts/{attempt_id}
    response: object of attempt
