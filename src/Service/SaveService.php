<?php

namespace Quiz\Service;

use Quiz\Models\ResultsModel;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\ResultsRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;

class SaveService
{
    /**
     * @param $answerId
     */
    public function saveUserAnswer($answerId)
    {
        $service    = new GetQuestionsService();
        $userId     = $_SESSION['user'];
        $quizId     = $_SESSION['quizId'];
        $questionNr = $_SESSION['questionNr'];
        $question   = $service->oneQuestion($quizId, $questionNr);
        $questionId = $question['id'];

        $this->saveAnswerModel($answerId, $quizId, $userId, $questionId);
    }

    /**
     * @param $answerId
     * @param $quizId
     * @param $userId
     * @param $questionId
     */
    public function saveAnswerModel($answerId, $quizId, $userId, $questionId)
    {
        $repo                     = new UserAnswerRepository();
        $answerModel              = new UserAnswerModel();
        $answerModel->answer_id   = $answerId;
        $answerModel->quiz_id     = $quizId;
        $answerModel->user_id     = $userId;
        $answerModel->question_id = $questionId;
        $repo->saveAnswer($answerModel);
    }

    /**
     * @param $name
     * @return string
     */
    public function saveUserModel($name)
    {
        $repo       = new UserRepository();
        $user       = new UserModel();
        $user->name = $name;

        return $repo->saveUser($user);
    }

    /**
     * @param $user_id
     * @param $quiz_id
     * @param $score
     */
    public function saveScore($user_id, $quiz_id, $score)
    {
        $repo           = new ResultsRepository();
        $model          = new ResultsModel();
        $model->user_id = $user_id;
        $model->quiz_id = $quiz_id;
        $model->score   = $score;
        $repo->save($model);
    }

}