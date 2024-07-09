<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>Mon Compte</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content class="ion-padding">
            <div v-if="user">
                <ion-card class="subscription-card">
                    <ion-card-header>
                        <ion-card-title>Mon abonnement</ion-card-title>
                    </ion-card-header>
                    <ion-card-content>
                        <ion-item>
                            <ion-label>Type</ion-label>
                            <ion-text>{{ product.name || "N/A" }}</ion-text>
                        </ion-item>
                        <ion-item>
                            <ion-label>Date de début</ion-label>
                            <ion-text>{{
                                formatDate(subscription.current_period_start)
                            }}</ion-text>
                        </ion-item>
                        <ion-item>
                            <ion-label>Renouvellement</ion-label>
                            <ion-text>{{
                                formatDate(subscription.current_period_end)
                            }}</ion-text>
                        </ion-item>
                        <ion-item>
                            <ion-label>Statut</ion-label>
                            <ion-text>{{ subscription.status }}</ion-text>
                        </ion-item>
                    </ion-card-content>
                </ion-card>

                <ion-card class="account-card">
                    <ion-card-header>
                        <ion-card-title class="ion-text-center"
                            >Informations du compte</ion-card-title
                        >
                    </ion-card-header>
                    <ion-card-content>
                        <ion-item>
                            <ion-label position="stacked">Nom</ion-label>
                            <ion-input
                                v-model="user.name"
                                placeholder="Entrez votre nom"
                            ></ion-input>
                        </ion-item>

                        <ion-item>
                            <ion-label position="stacked">Email</ion-label>
                            <ion-input
                                v-model="user.email"
                                type="email"
                                placeholder="Entrez votre adresse email"
                            ></ion-input>
                        </ion-item>

                        <ion-item>
                            <ion-label position="stacked"
                                >Mot de passe</ion-label
                            >
                            <ion-input
                                v-model="password"
                                type="password"
                                placeholder="Entrez un nouveau mot de passe"
                            ></ion-input>
                        </ion-item>

                        <ion-item>
                            <ion-label position="stacked"
                                >Confirmer le mot de passe</ion-label
                            >
                            <ion-input
                                v-model="passwordConfirmation"
                                type="password"
                                placeholder="Confirmez votre mot de passe"
                            ></ion-input>
                        </ion-item>

                        <ion-button
                            expand="full"
                            class="custom-button"
                            @click="updateAccount"
                            >Mettre à jour</ion-button
                        >
                    </ion-card-content>
                </ion-card>

                <ion-button
                    expand="full"
                    class="custom-button"
                    @click="accessStripePortal"
                    >Accéder au portail Stripe</ion-button
                >
                <ion-button expand="full" color="danger" @click="deleteAccount"
                    >Supprimer mon compte</ion-button
                >
                <ion-button expand="full" color="medium" @click="logout"
                    >Se déconnecter</ion-button
                >
            </div>
        </ion-content>
    </ion-page>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonItem,
    IonLabel,
    IonInput,
    IonButton,
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonButtons,
    IonBackButton,
    IonText,
} from "@ionic/vue";
import { defineComponent } from "vue";

const user = ref(null);
const password = ref("");
const passwordConfirmation = ref("");
const subscription = ref({});
const product = ref({});
const router = useRouter();

const fetchUser = async () => {
    try {
        const response = await axios.get("http://127.0.0.1:8000/api/user", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });
        user.value = response.data;
        fetchSubscription(); // Fetch subscription after user data
    } catch (error) {
        console.error("Error fetching user data:", error);
        if (error.response && error.response.status === 401) {
            router.push("/login");
        }
    }
};

const fetchSubscription = async () => {
    try {
        const response = await axios.get(
            "http://127.0.0.1:8000/api/subscription",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        subscription.value = response.data.subscription;
        product.value = response.data.product;
    } catch (error) {
        console.error(
            "Erreur lors de la récupération de l'abonnement :",
            error
        );
    }
};

const updateAccount = async () => {
    try {
        await axios.put(
            `http://127.0.0.1:8000/api/user/${user.value.id}`,
            {
                name: user.value.name,
                email: user.value.email,
                password: password.value,
                password_confirmation: passwordConfirmation.value,
            },
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        alert("Compte mis à jour avec succès");
    } catch (error) {
        console.error("Erreur lors de la mise à jour du compte :", error);
        alert("Erreur lors de la mise à jour du compte");
        if (error.response && error.response.status === 401) {
            router.push("/login");
        }
    }
};

const accessStripePortal = async () => {
    try {
        const response = await axios.get(
            "http://127.0.0.1:8000/api/stripe/customer",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        window.location.href = response.data.url;
    } catch (error) {
        console.error("Error accessing Stripe portal:", error);
        alert("Vous avez pas d'abonnement en cours !");
        if (error.response && error.response.status === 401) {
            router.push("/login");
        }
    }
};

const deleteAccount = async () => {
    if (confirm("Êtes-vous sûr de vouloir supprimer votre compte?")) {
        try {
            await axios.delete("http://127.0.0.1:8000/api/user", {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            alert("Compte supprimé avec succès");
            localStorage.removeItem("token");
            router.push("/signup");
        } catch (error) {
            console.error("Error deleting account:", error);
            alert("Erreur lors de la suppression du compte");
            if (error.response && error.response.status === 401) {
                router.push("/login");
            }
        }
    }
};

const logout = async () => {
    try {
        await axios.post(
            "http://127.0.0.1:8000/api/logout",
            {},
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        localStorage.removeItem("token");
        alert("Déconnexion réussie");
        router.push("/login");
    } catch (error) {
        console.error("Error logging out:", error);
        alert("Erreur lors de la déconnexion");
        if (error.response && error.response.status === 401) {
            router.push("/login");
        }
    }
};

const formatDate = (date) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(date).toLocaleDateString(undefined, options);
};

onMounted(fetchUser);
</script>

<style scoped>
.account-card,
.subscription-card {
    max-width: 400px;
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 auto 20px;
    padding: 20px;
}

.custom-button {
    --background: #15854b;
    --border-radius: 20px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
    margin-bottom: 10px;
}

.custom-button:hover {
    --background: #0f6d3b;
}
</style>
