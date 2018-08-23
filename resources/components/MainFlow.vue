<template>
	<div v-if="activeQuestion">
		<div>
			<h1>
				{{ question.question }}
			</h1>

			<label v-for="answer in question.answers">
				<input type="radio" name="radio"
				       :answer="answer"
				       v-model="answerId"
				       :value="answer.id"
				       :required = "isActive ? 'active' : ''">
				<div class="back-end box">
					<span>{{ answer.answer }}</span>
				</div>
			</label>

			<button @click="onAnswered">Next Questions</button>
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
            }
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
            }
        })
    }
</script>
