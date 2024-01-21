import React from 'react';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuIndicator,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger, navigationMenuTriggerStyle,
    NavigationMenuViewport,
} from "@/Components/ui/navigation-menu"
import {Link} from "@inertiajs/react";
import { Button } from '@/Components/ui/button';
import { PageProps } from '@/types';
import ApplicationLogo from '@/Components/ApplicationLogo';
import axios from 'axios';

const navigationMenuItems = [
    {
        name: 'Tableau de bord',
        href: '/dashboard'
    },
    {
        name: 'Clients',
        href: '/clients'
    },
    {
        name: 'Véhicules',
        href: '/cars'
    },
    {
        name: 'Locations',
        href: '/loans'
    }
]


const NavBar = ({ auth }:{auth: any}) => {
    const logout = () => {
        axios.post('/logout', {
            auth
        }).then(() => {
            window.location.href = '/';
        });
    }
    return (
        <div className={"h-12 w-full top-0 left-0 bg-transparent backdrop-blur border flex items-center px-8 gap-12 justify-between sticky"}>
            <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
            <div className={"flex-1 flex justify-center items-center"}>
                <NavigationMenu>
                    <NavigationMenuList>
                        {navigationMenuItems.map((item, index) => (
                            <NavigationMenuItem key={index}>
                                <Link href={item.href}>
                                    <NavigationMenuLink className={navigationMenuTriggerStyle()}>
                                        {item.name}
                                    </NavigationMenuLink>
                                </Link>
                            </NavigationMenuItem>
                        ))}
                    </NavigationMenuList>
                </NavigationMenu>
            </div>
            {auth.user ? <Button size={'sm'} onClick={() => logout()}>Se déconnecter</Button> : <div className={"flex gap-2"}>
                <Button size={'sm'} variant={"secondary"}><Link href={"auth/login"}>Connexion</Link></Button>
                <Button size={'sm'}><Link href={"auth/register"}>Inscription</Link></Button>
            </div>}
        </div>
    );
};

export default NavBar;
