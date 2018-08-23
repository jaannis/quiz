<template>
	<div v-if="activeQuestion" class="text-center">
		<div>
			<div class="margin__needed">
				<h1>
					{{ question.question }}
				</h1>
			</div>
			<div class="row">
				<div v-for="answer in question.answers" class="question__group">
					<AnswerItem :answer="answer" :on-answered="onAnswerPicked" :is-active="answer.id === answerId"/>
				</div>
			</div>
			<div class="container">

				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuemin="0"
					     aria-valuemax="100" :style="'width:' + activeQuestion.progressbar + '%'">
					</div>
				</div>
			</div>

			<div class="margin__needed">
				<button @click="onAnswered" :disabled="!answerId">Next Questions</button>
			</div>

		</div>
	</div>
</template>

<script>
    import QuizAnswer from "../models/model.quizAnswer";
    import {mapActions} from 'vuex';
    import AnswerItem from "./AnswerItem";

    export default {
        name: 'MainFlow',
        components: {AnswerItem, QuizAnswer},
        data() {
            return {
                answerId: null,
            }
        },

        computed: {

            activeQuestion: {
                get() {
                    return this.$store.state.activeQuestion;
                }
            }
            ,
            question: {
                get() {
                    return this.$store.state.activeQuestion;
                }
            }
            ,
            answerId: {
                get() {
                    return this.$store.state.answerId;
                }
                ,
                set(newValue) {
                    this.setActiveQuizId(newValue);
                }
            }
            ,
        }
        ,
        methods: Object.assign({}, mapActions([
            'answer',
        ]), {
            onAnswered() {
                if (!this.answerId) {
                    alert('No answer picked');
                    return;
                }
                this.answer(this.answerId);
                this.reset();
            },
            reset() {
                this.answerId = null;
            },

            onAnswerPicked(answerId) {
                this.answerId = answerId;
            },

        })
    }
</script>
