import Api from '../api.js';
import Quiz from "../models/model.quiz";
import Question from "../models/model.question";

class QuizRepository {
    constructor() {
        this.quizApi = new Api('ajaxTest'); //change
    }

    /**
     *
     * @return {Promise}
     */
    getAllQuizzes() {
        return new Promise(resolve => {
            this.quizApi.get('getQuizzes') //change
                .then(response => {
                    let quizzes = response.data.result.map(Quiz.fromArray);
                    resolve(quizzes);
                })
                .catch(() => alert('something went wrong'));
        })
    }

    start(name, quizId) {
        return new Promise(resolve => {
            this.quizApi.post('start', {name, quizId})
                .then(response => {
                    let question = Question.fromArray(response.data.result);
                    // console.log(response.data.result);

                    resolve(question)
                })
                .catch(() => alert('Something went wrong'));
        })
    }

    answer(answerId) {
        return new Promise(resolve => {
            this.quizApi.post('answer', {answerId})
                .then(response => {
                    resolve(
                        (typeof response.data.result === 'string') ?
                            response.data.result :
                        Question.fromArray(response.data.result));
                })
                .catch(() => {
                    debugger;
                })
        })
    }

}

export default new QuizRepository();