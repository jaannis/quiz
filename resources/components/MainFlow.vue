<template>
	<div v-if="activeQuestion" class="text-center">
		<div>
			<div>
				<h1>
					{{ question.question }}
				</h1>
			</div>

			<div v-for="answer in question.answers">
				<AnswerItem :answer="answer" :on-answered="onAnswerPicked" :is-active="answer.id === answerId"/>
			</div>

			<div>
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
        props: {
            answer: {
                type: QuizAnswer,
                required: true,
            },
            isActive: Boolean,
            onAnswered: {
                type: Function,
                required: true,
            },

        },

        computed: {

            activeQuestion: {
                get() {
                    return this.$store.state.activeQuestion;
                }
            },
            question: {
                get() {
                    return this.$store.state.activeQuestion;
                }
            },
            answerId: {
                get() {
                    return this.$store.state.answerId;
                },
                set(newValue) {
                    this.setActiveQuizId(newValue);
                }
            },
        },
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
            onClick() {
                this.onAnswered(this.answer.id);
            },
            onAnswerPicked(answerId) {
                this.answerId = answerId;
            },

        })
    }
</script>
