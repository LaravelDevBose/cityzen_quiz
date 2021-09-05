<template>
    <frontend-layout>
        <!-- Main -->
        <main id="resultPage" style="background-image: url('/assets/images/poppers2.png'); margin-top: 5rem;">
            <div class="container pt-5">
                <div class="cap">
                    <h2 class="text-center">THANK YOU FOR TAKING THE TEST</h2>
                    <div class="container">
                        <h5>
                            Helpgrove is a nonproﬁt organizationsupported by community leaders
                            Alienum phaedrum torquatos nec eu, vis detraxit periculis ex,
                            nihil expetendis in mei. Mei an pericula euripidis, hinc partem ei
                            est. Eos ei nisl graecis, vix aperiri
                        </h5>
                    </div>
                </div>

                <div class="scorecard py-5">
                    <h2>SCORE CARD</h2>
                    <img :src="route('front.index')+'/assets/images/Medal.png'" alt="Medal" style="margin: 0 auto;" />
                    <h4 v-if="userInfo.result >= 50">Congratulations You Are A Good Citizen</h4>
                    <h4 v-else>Opps! You Are Not A Good Citizen</h4>
                </div>
            </div>
        </main>
        <!-- Main -->
        <!-- Details -->
        <footer>
            <div class="container-fluid m-0">
                <div class="row">
                    <div class="col-md-8 p-5">
                        <p>
                            Name : <b>{{ userInfo.first_name }} {{ userInfo.last_name? userInfo.last_name : ''}}</b><br />
                            City : <b>{{ userInfo.city }}</b><br />
                            Pincode : <b>{{ userInfo.pin_code }}</b>
                        </p>
                        <h4>
                            You've Cleared the Test and proofed that you're a good Citizen
                        </h4>
                        <a :href="route('front.print.result')" target="_blank" class="btn download-btn">Download your Result</a>
                    </div>
                    <div class="col-md-4">
                        <img :src="route('front.index')+'/assets/images/Celeb.png'" alt="" srcset="" />
                    </div>
                </div>
            </div>
        </footer>
        <!-- Details -->

    </frontend-layout>
</template>

<script>
import FrontendLayout from "@/Layouts/FrontendLayout";

export default {
    name: "ResultPage",
    components: {
        FrontendLayout,
    },
    props:['userInfo']
}
</script>

<style scoped>

</style>
