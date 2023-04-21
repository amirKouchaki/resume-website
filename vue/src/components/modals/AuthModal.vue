<template>
    <modal-transition>
        <modal v-if="modals.showAuthModal" :toggle="modals.toggleAuthModal">
            <tabs-wrapper type="multi-page">
                <tab title="Login">
                    <h3 class="modal-form-heading">Login</h3>
                    <FormKit type="form" submit-label="Login">
                        <FormKit
                            type="email"
                            label="Email"
                            name="email"
                        ></FormKit>
                        <FormKit
                            type="password"
                            label="Password"
                            name="password"
                        ></FormKit>
                    </FormKit>
                </tab>
                <tab title="Sign Up">
                    <h3 class="modal-form-heading">Sign Up</h3>
                    <FormKit type="form" submit-label="Login">
                        <FormKit
                            type="email"
                            label="Email"
                            name="email"
                            validation="required"
                        ></FormKit>
                        <FormKit type="group">
                            <FormKit
                                type="password"
                                name="password"
                                label="Password"
                                validation="required"
                            />
                            <FormKit
                                type="password"
                                name="password_confirm"
                                label="Confirm Password"
                                validation="required|confirm"
                                validation-label="Confirmation"
                            />
                        </FormKit>
                        <FormKit
                            type="checkbox"
                            label="Remember Me"
                            name="remember_me"
                            :value="false"
                        />
                    </FormKit>
                </tab>
            </tabs-wrapper>
        </modal>
    </modal-transition>
</template>

<script setup>
import useModals from "../../stores/modals";
import ModalTransition from "../transitions/ModalTransition.vue";
import Modal from "../Modal.vue";
import TabsWrapper from "../TabsWrapper.vue";
import Tab from "../Tab.vue";
const modals = useModals();
</script>

<style></style>
