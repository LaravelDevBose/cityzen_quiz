<template>
    <frontend-layout>
        <!-- ṃain -->
        <main>
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-md-8">
                        <h2 style="font-weight: 600">
                            Check Your Citizenship Score, and Find Out “Are you a Good
                            Citizen?”
                        </h2>
                        <p>
                            Helpgrove is a nonproﬁt organizationsupported by community leaders
                            Alienum phaedrum <br />torquatos nec eu, vis detraxit periculis
                            ex, nihil expetendis in mei. Mei an pericula euripidis,<br />
                            hinc partem ei est. Eos ei nisl graecis, vix aperiri consequat
                            an.<br />
                            Eius lorem tincidunt vix at, vel pertinax sensibus id, error
                            epicurei mea. <br /><br />Phaedrum torquatos alienum nec eu, vis
                            detraxit periculis ex, nihil expetendis in mei. Mei an pericula
                            euripidis, hinc partem ei est. <br />Eos ei nisl graecis, vix
                            aperiri consequat an. Eius lorem tincidunt vix at, vel pertinax
                            sensibus id, error epicurei mea et. <br />Mea facilisis urbanitas
                            <br />moderatius id.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <img :src="route('front.index')+'/assets/images/Vector.png'" alt="citizen" />
                    </div>
                </div>
            </div>
        </main>
        <!-- ṃain -->

        <!-- Test Form -->
        <div class="test-form">
            <div class="container-fluid text-center p-0 m-0">
                <h2 style="font-weight: 600">Fill Up the Form and Take the Test</h2>
                <div class="container">
                    <h5>
                        Helpgrove is a nonproﬁt organizationsupported by community leaders
                        Alienum phaedrum torquatos nec eu, vis detraxit periculis ex, nihil
                        expetendis in mei. Mei an pericula euripidis, hinc partem ei est.
                        Eos ei nisl graecis, vix aperiri
                    </h5>
                </div>
                <div class="container-fluid form py-5 px-3">
                    <div class="container p-5">
                        <form class="row g-5" @submit.prevent="formSubmit">
                            <div class="col-md-6">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Name"
                                    required
                                    v-model="form.first_name"
                                />
                                <jet-input-error v-if="form.errors.wrong_ans_img" :message="form.errors.wrong_ans_img" class="mt-2" />
                            </div>
                            <div class="col-md-6">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Last Name"
                                    required
                                    v-model="form.last_name"
                                />
                                <jet-input-error v-if="form.errors.wrong_ans_img" :message="form.errors.wrong_ans_img" class="mt-2" />
                            </div>

                            <div class="col-md-6">
                                <select class="form-select" required v-model="form.pin_code">
                                    <option value="">Pincode</option>
                                    <option value="1207">1207</option>
                                </select>
                                <jet-input-error v-if="form.errors.wrong_ans_img" :message="form.errors.wrong_ans_img" class="mt-2" />
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" required v-model="form.city">
                                    <option value="">City</option>
                                    <option value="Dhaka">Dhaka</option>
                                </select>
                                <jet-input-error v-if="form.errors.wrong_ans_img" :message="form.errors.wrong_ans_img" class="mt-2" />
                            </div>

                            <div class="col-md-6">
                                <input
                                    type="tel"
                                    class="form-control"
                                    placeholder="Contact No."
                                    required
                                    v-model="form.phone_no"
                                />
                                <jet-input-error v-if="form.errors.wrong_ans_img" :message="form.errors.wrong_ans_img" class="mt-2" />
                            </div>
                            <div class="col-md-6">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Email"
                                    required
                                    v-model="form.email"
                                />
                                <jet-input-error v-if="form.errors.wrong_ans_img" :message="form.errors.wrong_ans_img" class="mt-2" />
                            </div>

                            <p class="text-center pt-4">
                                Helpgrove is a nonproﬁt organizationsupported by community
                                leaders Alienum phaedrum torquatos nec eu, vis detraxit
                                periculis ex
                            </p>

                            <div class="col-12">
                                <jet-button type="submit" class="btn btn-success btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Take Test
                                </jet-button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Test Form -->

    </frontend-layout>
</template>

<script>
import FrontendLayout from "@/Layouts/FrontendLayout";
import JetInputError from "@/Jetstream/InputError";
import JetButton from "@/Jetstream/Button";

export default {
    name: "HomePage",
    components: {
        FrontendLayout,
        JetInputError,
        JetButton
    },
    data(){
        return{
            form:this.$inertia.form({
                first_name:'',
                last_name:'',
                phone_no:'',
                email:'',
                pin_code:'',
                city:'',
            }),
        }
    },
    methods:{
        formSubmit(){
            this.form.post(route('front.user.register'), {
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
