import Api from '../api.js';
import Quiz from "../models/model.quiz";

class QuizRepository {
    constructor() {
        this.quizApi = new Api('ajax'); //change
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
                    // apstrada  ka vajag
                    //questions.fromArray
                    resolve()
                })
        })
    }
}

export default new QuizRepository();