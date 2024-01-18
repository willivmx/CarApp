import React from 'react';
import NavBar from "@/Components/NavBar";

const DashboardLayout = ({children}:{children: React.ReactNode}) => {
    return (
        <div className={"w-full min-h-screen"}>
            <NavBar/>
            {children}
        </div>
    );
};

export default DashboardLayout;
