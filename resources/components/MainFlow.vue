<template>
	<div v-if="activeQuestion">
		<div class="center">
			<div>
				<h1>
					{{ question.question }}
				</h1>
			</div>

			<div>
				<label class='radio-label' v-for="answer in question.answers">
					<input type="radio" name="radio"
					       :answer="answer"
					       v-model="answerId"
					       :value="answer.id"
					       :required="isActive ? 'active' : ''">
					<div class="back-end box">
						<span class='inner-label'>{{ answer.answer }}</span>
					</div>
				</label>
			</div>
			<div>
				<button @click="onAnswered">Next Questions</button>
			</div>

		</div>
	</div>
</template>

<script>
    import QuizAnswer from "../models/model.quizAnswer";
    import {mapActions} from 'vuex';

    export default {
        name: 'MainFlow',
        components: {QuizAnswer},
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

        },

        computed: {
            name: {
                get() {
                    return this.$store.state.name;
                }
            },
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
            }
        })
    }
</script>
