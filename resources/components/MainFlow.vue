<template>
	<div v-if="activeQuestion" class="text-center">
		<div>
			<div>
				<h1>
					{{ question.question }}
				</h1>
			</div>
			<!--:class="isActive ? 'checked' : ''"-->

			<div>
				<label v-for="answer in question.answers">
					<input type="radio" name="select" class="btn btn-secondary btn-lg"
					       :answer="answer"
					       v-model="answerId"
					       :value="answer.id"
					:class="[isActive ? 'active' : '']"

					>
					<span>{{ answer.answer }}</span>
				</label>
				{{ answer.isActive }}
			</div>
			<!--<div>-->
			<!--<input type="radio" id="control_03" name="select" value="3">-->
			<!--<label for="control_03">-->
			<!--<h2>Daaamn</h2>-->
			<!--<p>Now we're talking. It's gettin' a bit hairy out there in game land.</p>-->
			<!--</label>-->
			<!--</div>-->

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
            },

        })
    }
</script>
