<?php

namespace Quiz\Controllers;

use Quiz\Models\QuestionModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizAnswerRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserRepository;

class AjaxController extends BaseAjaxController
{
    public function startAction()
    {

        $name       = $this->post['name'];
        $repo       = new UserRepository();
        $user       = new UserModel();
        $user->name = $name;
        $repo->saveOrCreate($user);

        $quizId       = $this->post['quizId'];
        $questionRepo = new QuestionRepository();
        $question     = $questionRepo->getQuestions($quizId);
        $questionId   = $question;
        $answersRepo  = new QuizAnswerRepository();
        $answers      = $answersRepo->getQuizAnswers($questionId);
        $result       = $question + $answers;

        return $questionId;
    }

    public function saveUserAction()
    {
        $name       = $this->post['name'];
        $repo       = new UserRepository();
        $user       = new UserModel();
        $user->name = $name;
        $repo->saveOrCreate($user);

        return $user;
    }

    public function getQuizzesAction()
    {
        $repo = new QuizRepository();
        $list = $repo->all();

        return $list;
    }

    public function getQuestionsAction($quizId)
    {
        $repo            = new QuestionRepository();
        $listOfQuestions = $repo->getQuestions($quizId);

        return $listOfQuestions;

    }

    public function getAnswersAction($questionId)
    {
        $answersRepo   = new QuizAnswerRepository();
        $listOfAnswers = $answersRepo->getQuizAnswers($questionId);

        return $listOfAnswers;
    }

    public function getQuestion(int $index = 0)
    {
        $questions = [
            [
                'id'       => 1,
                'question' => 'What is the most basic language Microsoft made?',
                'answers'  => [
                    [
                        'id'     => 1,
                        'answer' => 'Visual Basic',
                    ],
                    [
                        'id'     => 2,
                        'answer' => 'DirectX',
                    ],
                    [
                        'id'     => 3,
                        'answer' => 'Batch',
                    ],
                    [
                        'id'     => 4,
                        'answer' => 'C++',
                    ],
                ],
            ],
            [
                'id'       => 2,
                'question' => 'What does HTML stand for?',
                'answers'  => [
                    [
                        'id'     => 1,
                        'answer' => 'Hyper Text Markup Language',
                    ],
                    [
                        'id'     => 2,
                        'answer' => 'Home Tool Markup Language',
                    ],
                    [
                        'id'     => 3,
                        'answer' => 'Hyperlinks and Text Markup Language',
                    ],
                ],
            ],
        ];
    }

}