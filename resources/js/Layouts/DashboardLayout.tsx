import React from 'react';
import NavBar from "@/Components/NavBar";

const DashboardLayout = ({children, auth}:{children: React.ReactNode, auth: any}) => {
    return (
        <div className={"w-full min-h-screen"}>
            <NavBar auth={auth}/>
            {children}
        </div>
    );
};

export default DashboardLayout;
