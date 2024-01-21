'use client';
import React, { useEffect } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Button } from '@/Components/ui/button';
import { ImageDown, Loader2, MoreVertical, Plus } from 'lucide-react';
import { Card, CardContent } from '@/Components/ui/card';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog';
import * as z from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { useForm } from 'react-hook-form';
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/Components/ui/form';
import { Input } from '@/Components/ui/input';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';
import axios from 'axios';
import { PageProps } from '@/types';

const Clients = ({ auth }: PageProps) => {
  const [clients, setClients] = React.useState<any[]>([]);
  const getClients = async () => {
    const data = await axios.get('/api/users').then(res => res.data).catch(err => console.log(err));
    setClients(data.filter((client: any) => client.role === 'user'));
  };

  React.useEffect(() => {
    getClients();
  }, []);


  return (
    <DashboardLayout>
      <div className={'w-full flex justify-between items-center px-8 py-4'}>
        <div className={'text-4xl font-extrabold'}><span>Liste des clients</span></div>
        <Dialog>
          <DialogTrigger>
              {auth.user && <Button className={'flex gap-1'}><Plus size={16} />Ajouter</Button>}
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Ajouter un client</DialogTitle>
            </DialogHeader>
          </DialogContent>
        </Dialog>
      </div>
        <div className={"w-full p-8 flex flex-wrap flex-col md:flex-row gap-4 justify-center items-center"}>
            {clients.map((client, index) => (
                    <ClientCard key={index} client={client} />
                )
            )}
        </div>
    </DashboardLayout>
  );
};

export default Clients;

const ClientCard = ({ client }: { client: any }) => {
    const [locations, setLocations] = React.useState<any[]>([]);
    const getLoans = async () => {
        const data = await axios.get('/api/loans').then(res => res.data).catch(err => console.log(err));
        setLocations(data.filter((loan: any) => client.id === loan.user_id));
    };

    React.useEffect(() => {
        getLoans();
    }, []);
    const locationsCount = locations.length;
    return (
        <Card className={'flex w-[300px] overflow-hidden'}>
            <CardContent className={'w-full h-full flex gap-2 items-center justify-center p-6'}>
                    <div className={'flex items-center justify-center h-10 w-10 rounded-full bg-gray-100'}>
                        {client.name.split(' ').map((name: string, index: number) => index < 2 && name[0])}
                    </div>
                    <div className={'flex flex-col'}>
                        <span className={'font-bold text-lg'}>{client.name}</span>
                        <span className={'text-sm'}>{client.email}</span>
                        <span className={'text-sm'}>Locations effectuées: {locationsCount}</span>
                    </div>
            </CardContent>
        </Card>
    );
}
