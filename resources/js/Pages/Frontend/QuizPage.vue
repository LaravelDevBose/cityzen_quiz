<template>
    <frontend-layout>
        <!-- Main -->
        <main>
            <div class="container-fluid p-1 py-5 p-md-4">
                <div class="cap">
                    <h2 class="text-center">
                        Over view of Test <br />
                        "Are you a Good Citizen"
                    </h2>
                    <div class="container">
                        <h5 style="text-align: center">
                            Helpgrove is a nonproﬁt organizationsupported by community leaders
                            Alienum phaedrum torquatos nec eu, vis detraxit periculis ex,
                            nihil expetendis in mei. Mei an pericula euripidis, hinc partem ei
                            est. Eos ei nisl graecis, vix aperiri
                        </h5>
                    </div>
                </div>

                <!-- Questions -->
                <div class="questions py-3" v-if="questions && questions.length > 0">
                    <form action="" @submit.prevent="formSubmit">
                        <div class="qcard py-5" v-for="(question, index) of questions" :key="index" >
                            <div class="container-fluid p-0" >
                                <div class="row p-0 mx-0" >
                                    <div class="col-md-9">
                                        <div class="container-fluid p-3 py-4 p-md-4 rounded">
                                            <div class="question">
                                                <div class="qno"></div>
                                                <h4 class="m-0">{{ question.question_title}}</h4>
                                            </div>
                                            <div class="lang">
                                                <ul>
                                                    <li>
                                                        <img
                                                            id="sp1"
                                                            class="sound"
                                                            :src="route('front.index')+'/assets/images/on.png'"
                                                            alt="speaker"
                                                            style="width: 25px; min-width: 25px"
                                                            @click.prevent="playQuestion(question.hin_aud_path, question.question_id, 1)"
                                                        />
                                                    </li>
                                                    <li class="hindi" :class="(nowPlay === 1 && question.question_id === curr_qus_id)? 'active': ''"
                                                        @click.prevent="playQuestion(question.hin_aud_path, question.question_id, 1)">Hindi</li>
                                                    <li class="english"
                                                        :class="(nowPlay === 2 && question.question_id === curr_qus_id)? 'active': ''"
                                                        @click.prevent="playQuestion(question.eng_aud_path, question.question_id, 2)">English</li>
                                                    <li class="gujrati"
                                                        :class="(nowPlay === 3 && question.question_id === curr_qus_id)? 'active': ''"
                                                        @click.prevent="playQuestion(question.guj_aud_path, question.question_id, 3)">Gujrati</li>
                                                </ul>
                                            </div>
                                            <div class="ans" v-if="form.answers[index].ans === ''" >
                                                <label>
                                                    <input v-model="form.answers[index].ans" value="1" class="uk-radio" type="radio" name="radio1" />
                                                    Yes!
                                                </label>
                                                <br />
                                                <label>
                                                    <input v-model="form.answers[index].ans" value="0"  class="uk-radio" type="radio" name="radio1" />
                                                    No!
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" v-if="form.answers[index].ans">
                                        <img :src="form.answers[index].ans == question.right_ans? question.right_img_path: question.wrong_img_path" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 offset-md-5">
                                <jet-button type="submit" class="btn btn-success btn-block w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Submit
                                </jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Questions -->
        </main>
        <!-- Main -->
    </frontend-layout>
</template>

<script>
import FrontendLayout from "@/Layouts/FrontendLayout";
import JetButton from "@/Jetstream/Button";
export default {
    name: "QuizPage",
    components: {
        FrontendLayout,
        JetButton
    },
    props:['questions'],
    data(){
        return{
            audio: '',
            nowPlay: 1,
            curr_qus_id: '',
            form:this.$inertia.form({
                answers:[],
            }),
        }
    },
    created() {
        if (this.questions && this.questions.length > 0){
            this.questions.forEach(ques=>{
                let data ={
                    ques_id: ques.question_id,
                    ans: ''
                }
                this.form.answers.push(data);
            });
        }
    },
    methods:{
        playQuestion (sound, quesId, type) {
            if (this.audio !== ''){
                this.audio.pause();
                this.audio.currentTime = 0;
            }
            if(sound) {
                this.audio = new Audio(sound);
                this.audio.play();
            }
            this.nowPlay = type;
            this.curr_qus_id = quesId;
        },
        formSubmit(){
            this.form.post(route('front.quiz.store'), {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => {
                    this.form.reset();
                }
            })
        },
    }
}
</script>

<style scoped>

</style>
