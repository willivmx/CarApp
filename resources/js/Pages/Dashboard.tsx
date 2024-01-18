import React, {useEffect} from 'react';
import DashboardLayout from "@/Layouts/DashboardLayout";
import NavBar from "@/Components/NavBar";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle
} from "@/Components/ui/card";
import axios from "axios";
import {Button} from "@/components/ui/button";

const Index = () => {

    return (
        <DashboardLayout>
            Tableau de bord
        </DashboardLayout>
    );
};

export default Index;
