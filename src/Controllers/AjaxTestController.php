<?php

namespace Quiz\Controllers;

use Quiz\Models\UserModel;
use Quiz\Repositories\UserRepository;

class AjaxTestController extends BaseAjaxController
{
    /** @var UserRepository */
//    protected $userRepository;

    /**
     * AjaxTestController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
//        $this->userRepository = $userRepository();
    }

    public function saveUserAction()
    {
        $name = $this->post['name'];
        /** @var UserModel $user */
        $user->name = $name;
        $repo = new UserRepository();
        $repo->saveOrCreate($user);
//        $this->userRepository->saveOrCreate($user);

        return $user;
    }

    public function getQuizzesAction()
    {
        return [
            [
                'id'   => 1,
                'name' => 'Programming',
            ],
        ];
    }

    public function indexAction()
    {
        return [
            'name'   => '',
            'quizes' => [
                [
                    'id'   => 1,
                    'name' => 'Programming',
                ],
            ],
        ];
    }

    public function startAction()
    {
        $quizId                    = $this->post['quizId'];
        $_SESSION['questionIndex'] = 0;

        return $this->getQuestion();
    }

    public function answerAction()
    {
        $answerId = $this->post['answerId'];

        $index = isset($_SESSION['questionIndex']) ? (int)$_SESSION['questionIndex'] : 0;
        $index++;
        $_SESSION['questionIndex'] = $index;

        return $this->getQuestion($index);
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

        if (!isset($questions[$index])) {
            return 'Good you have done!';
        }

        return $questions[$index];
    }
}