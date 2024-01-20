# Assignment Blueprint for backend

This is a Laravel blueprint for backend development, for creating a multi-tenant application **(single database)** to manage quizzes

## Installation

-   clone this repository `git clone git@github.com:mustaphahammouny/quiz.git`
-   cd into the project directory `cd quiz`
-   run `composer install`
-   run `npm install`
-   run `cp .env.example .env`
-   run migration and seeders `php artisan migrate --seed`
-   serve the application `php artisan serve` or use laravel valet, or any other server
-   run `npm run dev`
-   visit the application in your browser `http://localhost:8000`

## APIs

| **API**                     | **Endpoint**                       | **Method** | **Parameters**                                                                                                       | **Response**                   |
| --------------------------- | ---------------------------------- | ---------- | -------------------------------------------------------------------------------------------------------------------- | ------------------------------ |
| Auth                        | `/api/login`                       | post       | `email: string, password: string`                                                                                    | Token for accessing other APIs |
| Get all quizzes             | `/quizzes`                         | get        | -                                                                                                                    | List of quizzes                |
| Get single quiz             | `/quizzes/{quiz_id}`               | get        | -                                                                                                                    | Quiz object                    |
| Create quiz                 | `/quizzes`                         | post       | `title: string, description: string, start_time: datetime, end_time: datetime`                                       | Quiz object                    |
| Update quiz                 | `/quizzes/{quiz_id}`               | put        | `title: string, description: string, start_time: datetime, end_time: datetime`                                       | Object of quiz                 |
| Delete quiz                 | `/quizzes/{quiz_id}`               | delete     | -                                                                                                                    | Quiz object                    |
| Get all questions by quiz   | `/quizzes/{quiz_id}/questions`     | get        | -                                                                                                                    | List of questions              |
| Get single question         | `/questions/{question_id}`         | get        | -                                                                                                                    | Object of question             |
| Create question             | `/questions`                       | post       | `quiz_id: integer, question: string, description: string`                                                            | Question object                |
| Update question             | `/questions/{question_id}`         | put        | `question: string, description: string`                                                                              | Question object                |
| Delete question             | `/questions/{question_id}`         | delete     | -                                                                                                                    | Question object                |
| Get all choices by question | `/questions/{question_id}/choices` | get        | -                                                                                                                    | List of choices                |
| Get single choice           | `/choices/{choice_id}`             | get        | -                                                                                                                    | Choice object                  |
| Create choice               | `/choices`                         | post       | `question_id: integer, title: string, description: string, explanation: string, order: integer, is_correct: boolean` | Choice object                  |
| Update choice               | `/choices/{choice_id}`             | put        | `title: string, description: string, explanation: string, order: integer, is_correct: boolean`                       | Choice object                  |
| Delete choice               | `/choices/{choice_id}`             | delete     | -                                                                                                                    | Choice object                  |
| Get all attempts            | `/attempts`                        | get        | -                                                                                                                    | List of attempts               |
| Get single attempt          | `/attempts/{attempt_id}`           | get        | -                                                                                                                    | Attempt object                 |
