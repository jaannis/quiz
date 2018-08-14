<?php

namespace Quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use QuizService;

class QuizTest extends TestCase
{
    /** @var QuizRepository */
    private $quizRepository;
    private $userRepository;
    private $userAnswerRepository;

    public function setUp()
    {
        parent::setUp();

        $this->quizRepository = new QuizRepository;

        $data = [
            'Country capitals' => [
                'Latvia'    => [
                    'Riga'       => true,
                    'Ventspils'  => false,
                    'Jurmala'    => false,
                    'Daugavpils' => false,
                ],
                'Lithuania' => [
                    'Kaunas'    => false,
                    'Siaulia'   => false,
                    'Vilnius'   => true,
                    'Mazeikiai' => false,
                ],
                'Estonia'   => [
                    'Talling' => true,
                    'Paarnu'  => false,
                    'Tartu'   => false,
                    'Valga'   => false,
                ],
            ],
        ];

        $quizIds     = 0;
        $questionIds = 0;
        $answerIds   = 0;

        foreach ($data as $quizTitle => $questions) {
            $quiz       = new QuizModel;
            $quiz->id   = ++$quizIds;
            $quiz->name = $quizTitle;

            $this->quizRepository->addQuiz($quiz);

            foreach ($questions as $questionText => $answers) {
                $question           = new QuestionModel;
                $question->quizId   = $quiz->id;
                $question->id       = ++$questionIds;
                $question->question = $questionText;

                $this->quizRepository->addQuestion($question);

                foreach ($answers as $answerText => $isCorrect) {
                    $a             = new QuizAnswerModel();
                    $a->id         = ++$answerIds;
                    $a->answer     = $answerText;
                    $a->isCorrect  = $isCorrect;
                    $a->questionId = $question->id;
                }
            }
        }
    }

//    public function testQuizRetrievalById()
//    {
//        $repo = new UserAnswerRepository;
//        $answer->new UserModel;
//        $quiz = $this->quizRepository->getById(100);
//        self::assertEquals(100, $quiz->id);
//    }


}