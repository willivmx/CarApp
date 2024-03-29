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

const FUEL_TYPES = [
  {
    label: 'Essense',
    value: 'gasoline',
  }, {
    label: 'Diesel',
    value: 'diesel',
  }, {
    label: 'Electrique',
    value: 'electric',
  },
];

const CAR_STATUS = [
  {
    label: 'Disponible',
    value: 'available',
  },
  {
    label: 'Indisponible',
    value: 'unavailable',
  },
];

const Cars = ({ auth }: PageProps) => {
  const [cars, setCars] = React.useState<any[]>([]);
  const getCars = async () => {
    const data = await axios.get('/api/cars').then(res => res.data).catch(err => console.log(err));
    setCars(data);
  };

  React.useEffect(() => {
    getCars();
  }, []);

  return (
    <DashboardLayout auth={auth}>
      <div className={'w-full flex justify-between items-center px-8 py-4'}>
        <div className={'text-4xl font-extrabold'}><span>Liste des véhicules</span></div>
        <Dialog>
          <DialogTrigger>
              {auth.user  && <Button className={'flex gap-1'}><Plus size={16} />Nouveau</Button>}
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Ajouter un véhicule</DialogTitle>
            </DialogHeader>
            <CarAddingForm />
          </DialogContent>
        </Dialog>
      </div>
      <div
        className={'w-full h-auto flex flex-col sm:flex-row justify-center items-center flex-wrap gap-4 px-4 pb-8'}>
        {cars.map((car, index) => (
          <CarCard key={index} car={car} />
        ))}
      </div>
    </DashboardLayout>
  );
};

export default Cars;

const CarCard = ({ car }: { car: any }) => {
  return (
    <Card className='w-full sm:w-[300px]'>
      <CardContent className={'p-2 flex flex-col justify-center items-center'}>
        <div className={'w-full h-52 bg-accent rounded-lg'}>
          <img src={car.cover} alt='' className={'w-full h-full object-cover rounded-lg'} />
        </div>
        <div className={'w-full p-2 flex flex-col'}>
          <span className={'font-semibold flex justify-between items-center'}>
              <span>
                  {(`${car.brand} ${car.model}`).toUpperCase()} - {car.year}
              </span>
              <span className={'border flex justify-center items-center size-7 rounded-full cursor-pointer'}>
                  <MoreVertical size={16} />
              </span>
          </span>
          <span className={'text-sm'}>Immatriculation: {(car.plate_number).toUpperCase()}</span>
          <span className={'text-sm'}>Couleur: {car.color}</span>
          <span className={'text-sm'}>Carburant: {car.fuel_type}</span>
          <span className={'text-sm'}>Kilométrage: {car.mileage}</span>
          <span className={'text-sm'}>Status: {car.status}</span>
        </div>
          <Button className={"mt-2 w-full"}>Louer</Button>
      </CardContent>
    </Card>
  );
};

const CarAddingForm = () => {
  const formSchema = z.object({
    brand: z.string().min(2).max(50),
    model: z.string().min(2).max(50),
    year: z.number().max(new Date().getFullYear()),
    plate_number: z.string().min(6).max(6),
    color: z.string().min(2).max(50),
    fuel_type: z.string().min(2).max(10),
    mileage: z.number(),
    cover: z.string().min(0).max(50),
    status: z.string().min(2).max(50),
  });

  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      brand: '',
      model: '',
      year: new Date().getFullYear(),
      plate_number: '',
      color: '',
      fuel_type: 'gasoline',
      mileage: 0,
      cover: '',
      status: 'unavailable',
    },
  });

  const [cover, setCover] = React.useState<string | undefined>(undefined);
  const [isLoading, setIsLoading] = React.useState<boolean>(false)

  async function onSubmit(values: z.infer<typeof formSchema>) {
    setIsLoading(true)
    await axios.post('/api/cars/', {
      brand: values.brand,
      model: values.model,
      year: values.year,
      plate_number: values.plate_number,
      color: values.color,
      fuel_type: values.fuel_type,
      mileage: values.mileage,
      cover: values.cover,
      status: values.status
    }).then(() => {
      form.reset()
    }).catch((err) => {
      throw new Error(err)
    }).finally(() => {
      setIsLoading(false)
    })
  }


  return <Form {...form}>
    <form onSubmit={form.handleSubmit(onSubmit)} className='space-y-4'>
      <div className={'w-full flex gap-1.5'}>
        <FormField
          control={form.control}
          name='brand'
          render={({ field }) => (
            <FormItem
              className={'w-1/3'}>
              <FormLabel>Marque </FormLabel>
              <FormControl>
                <Input {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name='model'
          render={({ field }) => (
            <FormItem
              className={'w-1/3'}>
              <FormLabel>Modèle</FormLabel>
              <FormControl>
                <Input {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name='year'
          render={({ field }) => (
            <FormItem
              className={'w-1/3'}>
              <FormLabel>Année</FormLabel>
              <FormControl>
                <Input onChange={(e) => {
                  const value = e.target.value;
                  form.setValue('year', parseInt(value));
                }} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
      </div>
      <div className={'w-full flex gap-1.5'}>
        <FormField
          control={form.control}
          name='plate_number'
          render={({ field }) => (
            <FormItem
              className={'w-1/3'}>
              <FormLabel>Immatriculation</FormLabel>
              <FormControl>
                <Input {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name='color'
          render={({ field }) => (
            <FormItem
              className={'w-1/3'}>
              <FormLabel>Couleur</FormLabel>
              <FormControl>
                <Input {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name='fuel_type'
          render={({ field }) => (
            <FormItem className={'w-1/3'}>
              <FormLabel>Carburant</FormLabel>
              <Select onValueChange={field.onChange} defaultValue={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {FUEL_TYPES.map((item, index) => (
                    <SelectItem key={index} value={item.value}>
                      {item.label}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
              <FormMessage />
            </FormItem>
          )}
        />
      </div>
      <div className={'w-full flex gap-1.5'}>
        <FormField
          control={form.control}
          name='mileage'
          render={() => (
            <FormItem
              className={'w-1/2'}>
              <FormLabel>kilométrage</FormLabel>
              <FormControl>
                <Input type={'number'} onChange={(e) => {
                  const value = e.target.value;
                  form.setValue('mileage', parseInt(value));
                }} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name='status'
          render={({ field }) => (
            <FormItem className={'w-1/2'}>
              <FormLabel>Status</FormLabel>
              <Select onValueChange={field.onChange} defaultValue={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {CAR_STATUS.map((item, index) => (
                    <SelectItem key={index} value={item.value}>
                      {item.label}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
              <FormMessage />
            </FormItem>
          )}
        />
      </div>
      <div className={'flex flex-col gap-1 text-sm'}>
        <span>Couverture</span>
        <div className={'w-full h-[150px] rounded-xl border-dashed border-2 hover:bg-accent transition-all relative group z-[4] overflow-hidden'}>
          <input className={'size-full cursor-pointer opacity-0 absolute z-[3]'} type='file' onChange={(e) => {
            const file = e.target.files?.item(0);
            if (file) {
              const reader = new FileReader();
              reader.readAsDataURL(file);
              reader.onload = () => {
                const base64 = reader.result?.toString();
                form.setValue('cover', base64 as string);
                setCover(base64 as string);
              };
            }
          }} />

          {
            cover ?
              <img src={cover as string} className={'absolute w-full h-full group-hover:opacity-90 group-hover:scale-110 transition-all'} />
              :
              <ImageDown
                className={'opacity-50 z-[2] absolute top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%]'}
                size={60} />
          }
        </div>
      </div>
      <Button type='submit' className={'w-full'} disabled={isLoading}>{!isLoading ? "Ajouter" : <Loader2 size={16} className={"animate-spin"}/>}</Button>
    </form>
  </Form>;
};
