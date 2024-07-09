<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-title>Nos Offres</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content>
            <!-- Hero Section -->
            <ion-grid class="hero">
                <ion-row>
                    <ion-col size="12" class="hero-content">
                        <ion-text>
                            <h1>Nos Offres</h1>
                            <p>Profitez de nos Offres</p>
                        </ion-text>
                    </ion-col>
                </ion-row>
            </ion-grid>

            <!-- Sections offres Abonnement  -->
            <ion-grid class="features">
                <ion-row>
                    <ion-col size="12">
                        <h3>Nos Abonnements</h3>
                    </ion-col>
                </ion-row>
                <ion-row>
                    <ion-col
                        v-for="abonnement in abonnements"
                        :key="abonnement.id"
                        size="12"
                        size-md="4"
                    >
                        <ion-card class="subscription-card">
                            <ion-img
                                class="subscription-img"
                                :src="abonnement.image"
                            ></ion-img>
                            <ion-card-header>
                                <ion-card-title
                                    >{{ abonnement.name }} -
                                    {{ abonnement.price }}€ /
                                    mois</ion-card-title
                                >
                            </ion-card-header>
                            <ion-card-content>
                                <p v-html="abonnement.description"></p>
                                <ion-button
                                    class="cta-button"
                                    expand="full"
                                    @click="startCheckout(abonnement.id)"
                                    >Je m'abonne</ion-button
                                >
                            </ion-card-content>
                        </ion-card>
                    </ion-col>
                </ion-row>
            </ion-grid>
        </ion-content>
    </ion-page>
</template>

<script setup>
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonGrid,
    IonRow,
    IonCol,
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonImg,
    IonButton,
    IonText,
} from "@ionic/vue";
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const authStore = useAuthStore();
const abonnements = ref([]);

const fetchAbonnements = async () => {
    try {
        const response = await axios.get(
            "http://127.0.0.1:8000/api/abonnements"
        );
        abonnements.value = response.data;
    } catch (error) {
        console.error("Erreur lors de la récupération des abonnements:", error);
    }
};

onMounted(fetchAbonnements);

const startCheckout = async (productId) => {
    if (!authStore.isConnected) {
        router.push("/login");
        return;
    }

    try {
        const response = await axios.post(
            "http://127.0.0.1:8000/api/stripe/checkout",
            { product: productId },
            {
                headers: {
                    Authorization: `Bearer ${authStore.token}`,
                },
            }
        );
        window.location.href = response.data.url;
    } catch (error) {
        console.error("Erreur lors de l'initiation du paiement:", error);
        if (error.response && error.response.status === 401) {
            router.push("/login");
        } else {
            alert("Vous avez deja un abonnement en cours");
        }
    }
};
</script>

<style scoped>
.hero {
    background: linear-gradient(135deg, #c5ccc9, #15854b);
    color: white;
    text-align: center;
    padding: 100px 20px;
    position: relative;
}

ion-button {
    color: white;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 40px;
}

.features {
    padding: 20px;
}

.features h3 {
    text-align: center;
    margin-bottom: 20px;
}

.subscription-card {
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
}

.subscription-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.subscription-card ion-card-header {
    background: linear-gradient(135deg, #c5ccc9, #15854b);
    color: rgba(255, 255, 255, 0.482);
    padding: 15px;
}

.subscription-card ion-card-content {
    background-color: #f9f9f9;
    padding: 15px;
}

.subscription-img {
    width: 100%;
    object-fit: cover;
}
.cta-button {
    --background: #0b703c;
    --border-radius: 30px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
